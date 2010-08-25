Name:           gauffr
Version:        0.4
Release:        1%{?dist}
Summary:        Gestion of the Authentification Unified of Fedora FR
Summary(fr):    Gestion de l'Authentification Unifiée Fedora FR

Group:          Development/Libraries
License:        GPLv2+
URL:            http://projects.llaumgui.com/index.php/p/gauffr/doc/
Source0:        http://projects.llaumgui.com/media/upload/gauffr/files/%{name}-%{version}.tar.gz
Source1:        %{name}.cron.daily
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


%prep
%setup -q
%{__mv} Gauffr/conf/%{name}.ini ./


%build
# Empty build section, most likely nothing required.


%install
%{__rm} -rf %{buildroot}
%{__install} -d %{buildroot}%{_datadir}/php/
%{__install} -d %{buildroot}%{_sysconfdir}/%{name}
%{__install} -d %{buildroot}%{_bindir}/%{name}

%{__cp} -pr Gauffr %{buildroot}%{_datadir}/php
%{__cp} -pr %{name}.ini %{buildroot}/%{_sysconfdir}/%{name}

# script
%{__chmod}  755 bin/%{name}_clear_log.php
%{__cp} -pr bin/%{name}_clear_log.php %{buildroot}%{_bindir}/%{name}_clear_log

# Conf in /etc/
ln -s %{_sysconfdir}/%{name}/%{name}.ini %{buildroot}%{_datadir}/php/Gauffr/conf/%{name}.ini

# Add cron.daily
%{__install} -p -D -m 0755 %{SOURCE1} %{buildroot}%{_sysconfdir}/cron.daily/%{name}.cron



%clean
%{__rm} -rf %{buildroot}


%files
%defattr(-,root,root,-)
%doc doc/AUTHORS doc/ChangLog doc/LICENSE doc/tutorial doc/database
%config(noreplace) %{_sysconfdir}/%{name}/%{name}.ini
%{_sysconfdir}/cron.daily/%{name}.cron
%{_bindir}/%{name}_clear_log
%{_datadir}/php/Gauffr/


%changelog
* Mon Aug 16 2010 Guillaume Kulakowski <guillaume DOT kulakowski AT fedoraproject DOT org> - 0.4-1
- Update to Gauffr 0.4
- Add cronjob
- Add script in /usr/bin

* Sat Dec 05 2009 Guillaume Kulakowski <guillaume DOT kulakowski AT fedoraproject DOT org> - 0.3.1-1
- Update to Gauffr 0.3.1

* Sat Nov 21 2009 Guillaume Kulakowski <guillaume DOT kulakowski AT fedoraproject DOT org> - 0.3-1
- Update to Gauffr 0.3

* Sat Feb 28 2009 Guillaume Kulakowski <guillaume DOT kulakowski AT fedoraproject DOT org> - 0.1-1
- Initial packaging
