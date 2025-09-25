#!/bin/bash

# Define the plugin name and version
PLUGIN_NAME="google-reviews-plugin"
VERSION=$(grep "define('GOOGLE_REVIEWS_PLUGIN_VERSION'" google-reviews-plugin.php | sed -E "s/.*'([0-9.]+)'.*/\1/")

# Define the build directory
BUILD_DIR="build"
ZIP_NAME="${PLUGIN_NAME}-${VERSION}.zip"

# Create build directory if it doesn't exist
mkdir -p "$BUILD_DIR"

# Create a temporary directory for building
TEMP_DIR="$BUILD_DIR/temp"
rm -rf "$TEMP_DIR"
mkdir -p "$TEMP_DIR/$PLUGIN_NAME"

# Copy required files and directories
cp -r src vendor google-reviews-plugin.php index.php "$TEMP_DIR/$PLUGIN_NAME/"

# Remove development files
rm -rf "$TEMP_DIR/$PLUGIN_NAME/.git" "$TEMP_DIR/$PLUGIN_NAME/.gitignore" "$TEMP_DIR/$PLUGIN_NAME/build" "$TEMP_DIR/$PLUGIN_NAME/composer.json" "$TEMP_DIR/$PLUGIN_NAME/composer.lock" "$TEMP_DIR/$PLUGIN_NAME/node_modules" "$TEMP_DIR/$PLUGIN_NAME/tests" "$TEMP_DIR/$PLUGIN_NAME/scripts" "$TEMP_DIR/$PLUGIN_NAME/auth.json"
find "$TEMP_DIR/$PLUGIN_NAME" -name "*.md" -delete
find "$TEMP_DIR/$PLUGIN_NAME" -name "*.log" -delete
find "$TEMP_DIR/$PLUGIN_NAME" -name "*.zip" -delete

# Create the zip file
cd "$TEMP_DIR" && zip -r "../../$BUILD_DIR/$ZIP_NAME" .

# Clean up
cd ../..
rm -rf "$TEMP_DIR"

echo "Created $ZIP_NAME successfully!" 