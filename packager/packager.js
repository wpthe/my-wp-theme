const fs = require( 'fs' );
const archiver = require( 'archiver' );
const log = require( 'log-beautify' );
const config = require( './config' );

function setMainFileVersion() {
	if ( fs.existsSync( config.basePath + config.mainFile.path ) ) {
		fs.readFile( config.basePath + config.mainFile.path, 'utf8', function( err, data ) {
			if ( err ) {
				return console.error( err );
			}
			const prefix = config.mainFile.versionPrefix;
			const result = data.replace( prefix + /(\d+\.)(\d+\.)(\d)/g, prefix + config.version );

			fs.writeFile( config.basePath + config.mainFile.path, result, 'utf8', function( err ) {
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
		fs.writeFile( path, JSON.stringify( json, null, 2 ), 'utf8', function( err ) {
			if ( err ) {
				return console.error( err );
			}
		});
	}
}

function createArchive() {
	const output = fs.createWriteStream( config.basePath + config.name + '.zip' );
	const archive = archiver( 'zip', {});

	output.on( 'close', function() {
		console.log( '\n' );
		log.success_( '"' + config.name + '.zip" released under version ' + config.version + ' to the plugin folder.' );
		console.log( '\n' )
	});

	archive.on( 'error', function( err ) {
		throw err;
	});

	archive.pipe( output );

	let directories = config.directories;
	for ( let i = 0; i < directories.length; i++ ) {
		archive.directory( config.basePath + directories[i], config.name + '/' + directories[i], null );
	}

	let files = config.files;
	for ( let i = 0; i < files.length; i++ ) {
		archive.file( config.basePath + files[i], { name: config.name + '/' + files[i] });
	}

	archive.finalize();
}

setMainFileVersion();
setPackageVersion( config.packageJson );
setPackageVersion( config.composerJson );
createArchive();
