-- phpMyAdmin SQL Dump
-- version 2.8.0.4
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 14. Juli 2008 um 23:37
-- Server Version: 4.0.27
-- PHP-Version: 4.3.11
-- 
-- Datenbank: `usr_web225_2`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `commands`
-- 

DROP TABLE IF EXISTS `commands`;
CREATE TABLE `commands` (
  `id` bigint(20) NOT NULL auto_increment,
  `userid` varchar(64) NOT NULL default '0',
  `cmd` varchar(255) NOT NULL default '',
  `code` varchar(128) default NULL,
  `method` varchar(16) default NULL,
  `url` text NOT NULL,
  `params` text,
  `suchbegriffe` varchar(255) default NULL,
  `suchdienst` varchar(255) default NULL,
  `beispiel` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=105 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `emailaddrs`
-- 

DROP TABLE IF EXISTS `emailaddrs`;
CREATE TABLE `emailaddrs` (
  `id` bigint(20) NOT NULL auto_increment,
  `userid` bigint(20) NOT NULL default '0',
  `emailaddr` varchar(255) NOT NULL default '',
  `confirmcode` varchar(128) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `userdata`
-- 

DROP TABLE IF EXISTS `userdata`;
CREATE TABLE `userdata` (
  `id` bigint(20) NOT NULL auto_increment,
  `userid` bigint(20) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=31899 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `userpwd`
-- 

DROP TABLE IF EXISTS `userpwd`;
CREATE TABLE `userpwd` (
  `id` bigint(20) NOT NULL auto_increment,
  `userpwd` varchar(128) NOT NULL default '',
  `userid` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=13 ;
