Name:           gauffr
Version:        0.9
Release:        1%{?dist}
Summary:        Gestion of the Authentication Unified of Fedora-FR

Group:          Development/Libraries
License:        GPLv2+
URL:            http://projects.llaumgui.com/p/gauffr/doc/
Source0:        http://projects.llaumgui.com/media/upload/gauffr/files/%{name}-%{version}.tar.gz
Source1:        %{name}.cron.daily
Source2:        %{name}admin-httpd.conf
BuildRoot:      %{_tmppath}/%{name}-%{version}-%{release}-root-%(%{__id_u} -n)
BuildArch:      noarch

Requires:       php >= 5.2.1
Requires:       php-pear(components.ez.no/AuthenticationDatabaseTiein)
Requires:       php-pear(components.ez.no/Configuration)
Requires:       php-pear(components.ez.no/ConsoleTools)
Requires:       php-pear(components.ez.no/DatabaseSchema)
Requires:       php-pear(components.ez.no/EventLogDatabaseTiein)
Requires:       php-pear(components.ez.no/PersistentObject)


%description
Gauffr is an unified authentication system for multiple applications relying on
a existing application (GauffrMaster) to manage the authentication.

Gauffr allows different application (GauffrSlave) to query a unique database for
users information, centralizing the authentication through the slaves (forum,
CMS, blog, etc.). Gauffr return a GauffrUser. You will need to install or
develop a Gauffr plugin for all your GauffrSlave.


%package gauffradmin
Summary:        Gauffr web interface
Group:          Development/Libraries
Requires:       %{name} = %{version}-%{release}
Requires:       php-pear(components.ez.no/MvcTemplateTiein)
Requires:       php-pear(components.ez.no/TemplateTranslationTiein)


%description gauffradmin
GauffrAdmin is a the Gauffr WebUI.


%prep
%setup -q
mv Gauffr/conf/*.ini ./
rm doc/api/installdox
rm www/.htaccess
rm www/media/min/.htaccess

# Configure cache
sed -i -e "s|dirname( __FILE__ ) . '\/..\/..\/cache'|'%{_localstatedir}/lib/%{name}admin/cache'|g" Gauffr/GauffrAdmin/bootstrap.php
sed -i -e "s|\$min_cachePath = \$min_documentRoot . '\/..\/..\/cache';|\$min_cachePath = '%{_localstatedir}/lib/%{name}admin/cache';|g" www/media//min/config.php


%build
# Empty build section, most likely nothing required.


%install
rm -rf %{buildroot}
install -d %{buildroot}%{_datadir}/%{name}admin
install -d %{buildroot}%{_datadir}/php/
install -d %{buildroot}%{_sysconfdir}/%{name}
install -d %{buildroot}%{_localstatedir}/lib/%{name}admin

cp -pr www/* %{buildroot}%{_datadir}/%{name}admin
cp -pr Gauffr %{buildroot}%{_datadir}/php
cp -pr *.ini %{buildroot}/%{_sysconfdir}/%{name}
cp -pr cache %{buildroot}%{_localstatedir}/lib/%{name}admin

# script
install -d %{buildroot}%{_bindir}/%{name}
cp -pr bin/%{name}_clear_log.php %{buildroot}%{_bindir}/%{name}_clear_log

# Conf in /etc/
ln -s %{_sysconfdir}/%{name}/%{name}.ini %{buildroot}%{_datadir}/php/Gauffr/conf/%{name}.ini
ln -s %{_sysconfdir}/%{name}/%{name}_admin.ini %{buildroot}%{_datadir}/php/Gauffr/conf/%{name}_admin.ini

# Add cron.daily
install -p -D -m 0755 %{SOURCE1} %{buildroot}%{_sysconfdir}/cron.daily/%{name}.cron

# Add apache configuration
install -d %{buildroot}%{_sysconfdir}/httpd/conf.d
install -p -m 0644  %{SOURCE2} %{buildroot}%{_sysconfdir}/httpd/conf.d/%{name}admin.conf

# Langs
for file in %{buildroot}%{_datadir}/php/Gauffr/GauffrAdmin/translations/translation-*.ts; do
    lang=$(echo $(basename  $file) | sed "s|translation-\(.*\).ts$|\1|g");
    echo "%lang(${lang}) %{_datadir}/php/Gauffr/GauffrAdmin/translations/translation-${lang}.ts"
done > %{name}.lang


%clean
rm -rf %{buildroot}


%files
%defattr(-,root,root,-)
%doc doc/api doc/AUTHORS doc/ChangeLog doc/LICENSE doc/tutorial
%config(noreplace) %{_sysconfdir}/%{name}/%{name}.ini
%{_sysconfdir}/cron.daily/%{name}.cron
%{_bindir}/%{name}_clear_log
%{_datadir}/php/Gauffr/autoload/%{name}_autoload.php
%{_datadir}/php/Gauffr/conf/%{name}.ini
%{_datadir}/php/Gauffr/Gauffr
%{_datadir}/php/Gauffr/scripts/*.php
%{_datadir}/php/Gauffr/scripts/*.xml
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
* Sat Aug 03 2011 Guillaume Kulakowski <guillaume DOT kulakowski AT fedoraproject DOT org> - 0.9-1
- Upstream 0.9
- Add GauffrAdmin
- Add language support
- Add apache configuration

* Mon Aug 25 2010 Guillaume Kulakowski <guillaume DOT kulakowski AT fedoraproject DOT org> - 0.4-1
- Upstream 0.4
- Add cronjob
- Add script in /usr/bin

* Sat Dec 05 2009 Guillaume Kulakowski <guillaume DOT kulakowski AT fedoraproject DOT org> - 0.3.1-1
- Upstream 0.3.1

* Sat Nov 21 2009 Guillaume Kulakowski <guillaume DOT kulakowski AT fedoraproject DOT org> - 0.3-1
- Upstream 0.3

* Sat Feb 28 2009 Guillaume Kulakowski <guillaume DOT kulakowski AT fedoraproject DOT org> - 0.1-1
- Initial packaging
