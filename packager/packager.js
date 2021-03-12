const fs = require( 'fs' );
const archiver = require( 'archiver' );
const log = require( 'log-beautify' );
const config = require( './config' );

function setMainFileVersion() {
	if ( fs.existsSync( config.mainFile.file ) ) {
		fs.readFile( config.mainFile.file, 'utf8', function( err, data ) {
			if ( err ) {
				return console.error( err );
			}
			const prefix = config.mainFile.versionPrefix;
			const result = data.replace( prefix + /(\d+\.)(\d+\.)(\d)/g, prefix + config.version );

			fs.writeFile( config.mainFile.file, result, 'utf8', function( err ) {
				if ( err ) {
					return console.error( err );
				}
			});
		});
	}
}

function setPackageVersion( path ) {
	if ( path && fs.existsSync( path ) ) {
		const json = require( path );
		json.version = config.version;
		fs.writeFile( path, JSON.stringify( json, null, 2 ), function( err ) {
			if ( err ) {
				return console.error( err );
			}
		});
	}
}

function createArchive( sources ) {
	const sourcesPostfix = sources ? '-sources' : '';
	const output = fs.createWriteStream( config.output + config.name + sourcesPostfix + '.zip' );
	const archive = archiver( 'zip', {});

	output.on( 'close', function() {
		if ( ! sources ) {
			console.log( '\n' );
			log.success_( '"' + config.name + sourcesPostfix + '.zip" released under version ' + config.version + ' to the theme folder.' );
		} else {
			log.success_( '"' + config.name + sourcesPostfix + '.zip" was placed near.' );
			console.log( '\n' )
		}
	});

	archive.on( 'error', function( err ) {
		throw err;
	});

	archive.pipe( output );

	let directories = config.directories;
	if ( sources ) directories = directories.concat( config.sources.directories );
	for ( let i = 0; i < directories.length; i++ ) {
		archive.directory( '../' + directories[i], config.name + '/' + directories[i], null );
	}

	let files = config.files;
	if ( sources ) files = files.concat( config.sources.files );
	for ( let i = 0; i < files.length; i++ ) {
		archive.file( '../' + files[i], { name: config.name + '/' + files[i] });
	}

	archive.finalize();
}

setMainFileVersion();
setPackageVersion( config.sources.packageJson );
setPackageVersion( config.sources.composerJson );
createArchive( false );
createArchive( true );
