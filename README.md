Introduction
============

Gestation of the Project
------------------------
Gauffr is initially a project designed for the website [Fedora-Fr.org](http://www.fedora-fr.org) Its name means: "**G**estion of the **A**uthentication **U**nified of **F**edora **FR**".

![Gauffr schema 2](http://www.llaumgui.com/public/gauffr/Gauffr_schema2.png "Gauffr schema 2")

What is Gauffr ?
----------------
Gauffr is an unified authentication system for multiple applications relying on a existing application (GauffrMaster) to manage the authentication.

Gauffr allows different application (GauffrSlave) to query a unique database for users information, centralizing the authentication through the slaves (forum, CMS, blog, etc.). Gauffr return a GauffrUser. You will need to install or develop a Gauffr plugin for all your GauffrSlave ([[AvailablePlugins]]).

![Gauffr schema 1](http://www.llaumgui.com/public/gauffr/Gauffr_schema.png "Gauffr schema 1")

Gauffr features
===============
Presents
--------
 * Authentication with login or AltLogin
 * Credential management
 * PersistantObject
 * Documentation and tutorial
 * Web interface of administration

Futures (1.1 ?)
---------------
 * Synchronisation between GauffrSlave and GauffrMaster emails
 * OpenID support

Statut
======
Version 0.9 Release Candidate.

Gauffr videos on YouTube
[See Gauffr in action on YouTube](http://www.youtube.com/user/llaumgui007#p/c/AE9E0F17191C21F1).

