homebanner
=========

Plugin homebanner for Magix CMS 3

### version 

[![release](https://img.shields.io/github/release/magix-cms/homebanner.svg)](https://github.com/magix-cms/homebanner/releases/latest)

## Installation
 * Décompresser l'archive dans le dossier "plugins" de magix cms
 * Connectez-vous dans l'administration de votre site internet 
 * Cliquer sur l'onglet plugins du menu déroulant pour sélectionner homebanner.
 * Une fois dans le plugin, laisser faire l'auto installation
 * Il ne reste que la configuration du plugin pour correspondre avec vos données.

## Upgrade
 * Supprimer l'ancien plugin
 * Envoyer les nouveaux fichiers
 * Connectez-vous dans l'administration de votre site internet 
 * Cliquer sur l'onglet plugins du menu déroulant pour sélectionner homebanner.
 * Une fois dans le plugin, laisser faire l'auto update

### MISE A JOUR
La mise à jour du plugin est à effectuer en remplaçant le dossier du plugin par la nouvelle version
et de se connecter à l'administration de celui-ci pour faire la mise à jour des tables SQL.

#### Liste des images disponible avec drag & drop

![screenshot-2018-2-27 homebanner magix cms admin](https://user-images.githubusercontent.com/356674/36722070-de6a3f66-1bac-11e8-92ca-36bfbe83bad3.png)
#### Edition d'un slide

![screenshot-2018-2-27 homebanner magix cms admin 2](https://user-images.githubusercontent.com/356674/36722069-de51a4e2-1bac-11e8-89af-676489e62f3e.png)

### Ajouter dans home.tpl la ligne suivante

```smarty
{block name="main:after"}
    {include file="homebanner/homebanner.tpl" orientation="top"}
{/block}
````

<pre>

This file is a plugin of Magix CMS.
Magix CMS, a CMS optimized for SEO

Copyright (C) 2008 - 2018 magix-cms.com support[at]magix-cms[point]com

AUTHORS :

 * Gerits Aurelien (Author - Developer) aurelien[at]magix-cms[point]com


Redistributions of files must retain the above copyright notice.
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see .

####DISCLAIMER

Do not edit or add to this file if you wish to upgrade magixcms to newer
versions in the future. If you wish to customize magixcms for your
needs please refer to magix-cms.com for more information.

</pre>
