<?php
/**
 * Dynamically loads the class attempting to be instantiated elsewhere in the
 * plugin.
 *
 * @package Sober_Check
 */
spl_autoload_register( 'sobercheck_autoloader' );

function sobercheck_autoloader( $class_name ) {

    // If the specified $class_name does not include our namespace, duck out.
    if ( false === strpos( $class_name, 'Sobercheck' ) ) {
        return;
    }

    // Split the class name into an array to read the namespace and class.
    $file_parts = explode( '\\', $class_name );

    // Do a reverse loop through $file_parts to build the path to the file.
    $resource_path  = false;
    $directory = '';
	$file_name = '';
    for ( $i = count( $file_parts ) - 1; $i > 0; $i-- ) {
        // Read the current component of the file part.
        $current = strtolower( $file_parts[ $i ] );
        $current = str_ireplace( '_', '-', $current );

        if ( count( $file_parts ) - 1 === $i ) {
            if ( 'traits' == strtolower( $file_parts[ count( $file_parts ) - 2 ] ) ) {
                // Grab the name of the interface from its qualified name.
                $trait_name = explode( '_', $file_parts[ count( $file_parts ) - 1 ] );
                $trait_name = strtolower( $trait_name[0] );
        
                $directory = 'traits';
                $file_name = "trait-$trait_name.php";
            } else {
                $directory = 'classes';
                $file_name = "class-$current.php";
            }

        }
        
        $resource_path  = sprintf( '%s/inc/%s/%s', SOBER_CHECK_DIR_PATH, $directory, $file_name );

        if ( ! empty( $resource_path ) && file_exists( $resource_path ) ) {
            require_once $resource_path;
        }

    }
}
