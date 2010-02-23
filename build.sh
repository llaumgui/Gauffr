#!/bin/sh

#
# Create a new Gauffr package
#


# Variables
API_PATH=doc/api
GAUFFR_VERSION=0.3.1
BUILD_PATH=../gauffr-${GAUFFR_VERSION}


# Pre cleanup
if [ -d ${BUILD_PATH} ]; then
	rm -rf ${BUILD_PATH}
fi


# Create package
mkdir ${BUILD_PATH}
cp -R doc ${BUILD_PATH}
cp -R Gauffr ${BUILD_PATH}


# Use gauffr.ini
rm -f  ${BUILD_PATH}/Gauffr/conf/gauffr.ini
mv ${BUILD_PATH}/Gauffr/conf/gauffr.ini.exemple \
     ${BUILD_PATH}/Gauffr/conf/gauffr.ini

# Cleanup .svn
find ${BUILD_PATH}/ -name '.svn' -type d -exec rm -rf {} \;

# Tag version in header
find ${BUILD_PATH}/Gauffr/ -name '*.php' -exec sed -i "s/@version \/\/autogentag\/\//@version ${GAUFFR_VERSION}/g" {} \;

# phpDoc
if [ -d ${BUILD_PATH}}/${API_PATH} ]; then
    rm -rf ${BUILD_PATH}}/${API_PATH}
fi
phpdoc --title "Gauffr v${GAUFFR_VERSION}" -ue on -i '*_autoload.php' -t  ${BUILD_PATH}/${API_PATH} -d ${BUILD_PATH}/Gauffr/

# tar.gz
tar -czvf ${BUILD_PATH}.tar.gz ${BUILD_PATH}/
