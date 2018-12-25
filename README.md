# JPHP for Android project 
[![Build Status](https://travis-ci.org/VenityStudio/android.svg?branch=master)](https://travis-ci.org/VenityStudio/android)
[![Venity project status](https://img.shields.io/badge/Venity-unsupported-red.svg)](https://vk.com/venity)
JPHP and JavaFX for Android OS

## building sandbox

Install last version of jppm and android sdk

And run this script

```bash
cd jphp-android-ext && jppm publish --yes && cd ..
cd jppm-android-plugin && jppm publish --yes && cd ../Demo
jppm update
jppm android:apk
```

You find apk file on ``sandbox/build/javafxports/android``
