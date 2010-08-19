#!/bin/sh

#
# Create a new Gauffr package
#


# Variables
API_PATH=doc/api
GAUFFR_VERSION=0.4
GAUFFR_PATH=../
BUILD_PATH=../../gauffr-${GAUFFR_VERSION}


# Pre cleanup
if [ -d ${BUILD_PATH} ]; then
	rm -rf ${BUILD_PATH}
fi


# Create package
mkdir ${BUILD_PATH}
cp -R ${GAUFFR_PATH}bin ${BUILD_PATH}
cp -R ${GAUFFR_PATH}doc ${BUILD_PATH}
cp -R ${GAUFFR_PATH}build-tools/Doxyfile ${BUILD_PATH}/doc
cp -R ${GAUFFR_PATH}Gauffr ${BUILD_PATH}


# Use gauffr.ini
rm -f  ${BUILD_PATH}/Gauffr/conf/gauffr.ini
mv ${BUILD_PATH}/Gauffr/conf/gauffr.ini.exemple \
     ${BUILD_PATH}/Gauffr/conf/gauffr.ini

# Cleanup .svn
find ${BUILD_PATH}/ -name '.svn' -type d -exec rm -rf {} \;

# Tag version in header
find ${BUILD_PATH}/Gauffr/ -name '*.php' -exec sed -i "s/@version \/\/autogentag\/\//@version ${GAUFFR_VERSION}/g" {} \;
sed -i "s/@version \/\/autogentag\/\//@version ${GAUFFR_VERSION}/g" ${BUILD_PATH}/Doxyfile;

# phpDoc
if [ -d ${BUILD_PATH}}/${API_PATH} ]; then
    rm -rf ${BUILD_PATH}}/${API_PATH}
fi
doxygen ${BUILD_PATH}/doc/Doxyfile

# tar.gz
tar -czvf ${BUILD_PATH}.tar.gz ${BUILD_PATH}/
