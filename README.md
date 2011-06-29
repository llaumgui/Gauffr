Introduction
============

Gestation of the Project
------------------------
Gauffr is the **G**estion of the **A**uthentication **U**nified of **F**edora **FR**.

![Gauffr schema 2](http://www.llaumgui.com/public/gauffr/Gauffr_schema2.png "Gauffr schema 2")

What is Gauffr ?
----------------
Gauffr is an unified authentication application.

Gauffr allow to different application (GauffrSlave) to interrogate the same database of users (forum, CMS, blog, etc.). Gauffr return a GauffrUser. You must also install (or develop) a Gauffr plugin for all your GauffrSlave.

![Gauffr schema 1](http://www.llaumgui.com/public/gauffr/Gauffr_schema.png "Gauffr schema 1")

Statut
======
Version 0.4 testing.

Gauffr features
===============
Presents
--------
 * Authentication with login or AltLogin with or without credential and return a GauffrUser
 * Gauffr:info() for return informations about Gauffr and check requirement
 * PersistantObject

Futures
-------
 * Synchronisation between GauffrSlave and GauffrMaster emails
 * OpenID support
