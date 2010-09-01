#!/bin/sh

#
# Create a new Gauffr package
#


# Variables
API_PATH=doc/api
GAUFFR_VERSION=0.5-dev
GAUFFR_PATH=../
BUILD_PATH=../../gauffr-${GAUFFR_VERSION}
ECHO="echo -e"

# motd
${ECHO} "\n#\n# Gauffr builder\n# build version ${GAUFFR_VERSION}\n#\n"


# Pre cleanup
${ECHO} "# Clean build path - Start"
if [ -d ${BUILD_PATH} ]; then
	rm -rf ${BUILD_PATH}
fi
${ECHO} "# Clean build path - End\n"


# Create package
${ECHO} "# Create package - Start"
mkdir ${BUILD_PATH}
cp -R ${GAUFFR_PATH}bin ${BUILD_PATH}
mkdir ${BUILD_PATH}/cache
cp -R ${GAUFFR_PATH}doc ${BUILD_PATH}
cp -R ${GAUFFR_PATH}build-tools/Doxyfile ${BUILD_PATH}/doc
cp -R ${GAUFFR_PATH}Gauffr ${BUILD_PATH}
cp -R ${GAUFFR_PATH}www ${BUILD_PATH}
${ECHO} "# Create package - End\n"


# Use gauffr.ini
${ECHO} "# Use gauffr.ini - Start"
rm -f  ${BUILD_PATH}/Gauffr/conf/gauffr.ini
mv ${BUILD_PATH}/Gauffr/conf/gauffr.ini.exemple \
     ${BUILD_PATH}/Gauffr/conf/gauffr.ini
${ECHO} "# Use gauffr.ini - End\n"


# Cleanup .svn
${ECHO} "# Cleanup .svn - Start"
find ${BUILD_PATH}/ -name '.svn' -type d -exec rm -rf {} \; >/dev/null 2>&1
${ECHO} "# Cleanup .svn - End\n"


# Tag version in header
${ECHO} "# Tag version in header - Start"
find ${BUILD_PATH}/Gauffr/ -name '*.php' -exec sed -i "s/@version \/\/autogentag\/\//@version ${GAUFFR_VERSION}/g" {} \;
sed -i "s/\/\/autogentag\/\//${GAUFFR_VERSION}/g" ${BUILD_PATH}/doc/Doxyfile;
${ECHO} "# Tag version in header - End\n"


# Doxygen
${ECHO} "# Doxygen - Start"
if [ -d ${BUILD_PATH}}/${API_PATH} ]; then
    rm -rf ${BUILD_PATH}}/${API_PATH}
fi
cd ${BUILD_PATH}/doc ; doxygen Doxyfile
${ECHO} "# Doxygen - End\n"


# tar.gz
${ECHO} "# tar - Start"
tar -czf ${BUILD_PATH}.tar.gz ${BUILD_PATH}/
${ECHO} "# tar - End\n\n"
