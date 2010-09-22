Name:           gauffr
Version:        0.5
Release:        1%{?dist}
Summary:        Gestion of the Authentication Unified of Fedora FR
Summary(fr):    Gestion de l'Authentification Unifiée Fedora FR

Group:          Development/Libraries
License:        GPLv2+
URL:            http://projects.llaumgui.com/index.php/p/gauffr/doc/
Source0:        http://projects.llaumgui.com/media/upload/gauffr/files/%{name}-%{version}.tar.gz
Source1:        %{name}.cron.daily
Source2:        %{name}admin-httpd.conf
BuildRoot:      %{_tmppath}/%{name}-%{version}-%{release}-root-%(%{__id_u} -n)
BuildArch:      noarch

Requires:       php >= 5.2.1
Requires:       php-pear(components.ez.no/AuthenticationDatabaseTiein)
Requires:       php-pear(components.ez.no/Configuration)
Requires:       php-pear(components.ez.no/ConsoleTools)
Requires:       php-pear(components.ez.no/EventLogDatabaseTiein)
Requires:       php-pear(components.ez.no/PersistentObject)


%description
Gauffr is a complete solution of SLO (Single Log-On) based on a master
application (the GauffrMaster) and applications slaves (GauffrSlave) delegating
all or part of their identification GauffrMaster.
%description -l fr
Gauffr est une solution complète de SLO (Single Log-On) basée sur une
application maitresse (le GauffrMaster) et des applications esclaves
(GauffrSlave) déléguant tout ou parti de leur identification au GauffrMaster.


%package gauffradmin
Summary:        Gauffr web interface
Summary(fr):    Interface web pour Gauffr
Group:          Development/Libraries
Requires:       %{name} = %{version}-%{release}
Requires:       php-pear(components.ez.no/MvcTemplateTiein)
Requires:       php-pear(components.ez.no/TemplateTranslationTiein)

%description gauffradmin
GauffrAdmin is a WebUI for administrate Gauffr.
%description -l fr gauffradmin
GauffrAdmin est l'interface web d'administration de Gauffr.


%prep
%setup -q
%{__mv} Gauffr/conf/*.ini ./
sed -i -e "s|dirname( __FILE__ ) . '\/..\/..\/cache'|'%{_localstatedir}/lib/%{name}admin/cache'|g" Gauffr/GauffrAdmin/bootstrap.php

%build
# Empty build section, most likely nothing required.


%install
%{__rm} -rf %{buildroot}
%{__install} -d %{buildroot}%{_datadir}/%{name}admin
%{__install} -d %{buildroot}%{_datadir}/php/
%{__install} -d %{buildroot}%{_sysconfdir}/%{name}
%{__install} -d %{buildroot}%{_localstatedir}/lib/%{name}admin

%{__cp} -pr www/* %{buildroot}%{_datadir}/%{name}admin
%{__cp} -pr www/.htaccess %{buildroot}%{_datadir}/%{name}admin
%{__cp} -pr Gauffr %{buildroot}%{_datadir}/php
%{__cp} -pr *.ini %{buildroot}/%{_sysconfdir}/%{name}
%{__cp} -pr cache %{buildroot}%{_localstatedir}/lib/%{name}admin

# script
%{__install} -d %{buildroot}%{_bindir}/%{name}
%{__chmod}  755 bin/%{name}_clear_log.php
%{__cp} -pr bin/%{name}_clear_log.php %{buildroot}%{_bindir}/%{name}_clear_log

# Conf in /etc/
ln -s %{_sysconfdir}/%{name}/%{name}.ini %{buildroot}%{_datadir}/php/Gauffr/conf/%{name}.ini
ln -s %{_sysconfdir}/%{name}/%{name}_admin.ini %{buildroot}%{_datadir}/php/Gauffr/conf/%{name}_admin.ini

# Add cron.daily
%{__install} -p -D -m 0755 %{SOURCE1} %{buildroot}%{_sysconfdir}/cron.daily/%{name}.cron

# Add apache configuration
%{__install} -d %{buildroot}%{_sysconfdir}/httpd/conf.d
%{__install} -p -m 0644  %{SOURCE2} %{buildroot}%{_sysconfdir}/httpd/conf.d/%{name}admin.conf

# Langs
for file in %{buildroot}%{_datadir}/php/Gauffr/GauffrAdmin/translations/translation-*.ts; do
    lang=$(echo $(basename  $file) | sed "s|translation-\(.*\).ts$|\1|g");
    echo "%lang(${lang}) %{_datadir}/php/Gauffr/GauffrAdmin/translations/translation-${lang}.ts"
done > %{name}.lang


%clean
%{__rm} -rf %{buildroot}


%files
%defattr(-,root,root,-)
%doc doc/api doc/AUTHORS doc/ChangLog doc/LICENSE doc/tutorial doc/database
%config(noreplace) %{_sysconfdir}/%{name}/%{name}.ini
%{_sysconfdir}/cron.daily/%{name}.cron
%{_bindir}/%{name}_clear_log
%{_datadir}/php/Gauffr/autoload/%{name}_autoload.php
%{_datadir}/php/Gauffr/conf/%{name}.ini
%{_datadir}/php/Gauffr/Gauffr
%{_datadir}/php/Gauffr/%{name}.php


%files  -f %{name}.lang gauffradmin
%defattr(-,root,root,-)
%config(noreplace) %{_sysconfdir}/%{name}/%{name}_admin.ini
%config(noreplace) %{_sysconfdir}/httpd/conf.d/%{name}admin.conf
%{_datadir}/php/Gauffr/autoload/%{name}_admin_autoload.php
%{_datadir}/php/Gauffr/conf/%{name}_admin.ini
%{_datadir}/php/Gauffr/GauffrAdmin
%{_datadir}/%{name}admin
%attr(755,apache,root) %{_localstatedir}/lib/%{name}admin/cache


%changelog
* Thu Sep 21 2010 Guillaume Kulakowski <guillaume DOT kulakowski AT fedoraproject DOT org> - 0.5-1
- Update to Gauffr 0.5
- Add GauffrAdmin
- Add language support
- Add apache configuration

* Mon Aug 25 2010 Guillaume Kulakowski <guillaume DOT kulakowski AT fedoraproject DOT org> - 0.4-1
- Update to Gauffr 0.4
- Add cronjob
- Add script in /usr/bin

* Sat Dec 05 2009 Guillaume Kulakowski <guillaume DOT kulakowski AT fedoraproject DOT org> - 0.3.1-1
- Update to Gauffr 0.3.1

* Sat Nov 21 2009 Guillaume Kulakowski <guillaume DOT kulakowski AT fedoraproject DOT org> - 0.3-1
- Update to Gauffr 0.3

* Sat Feb 28 2009 Guillaume Kulakowski <guillaume DOT kulakowski AT fedoraproject DOT org> - 0.1-1
- Initial packaging
