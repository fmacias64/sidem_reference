<?php
/**
 * $Id: addDocFieldBL.php,v 1.8 2003/08/12 08:39:04 michael Exp $
 *
 * Add a document field.
 *
 * Copyright (c) 2003 Jam Warehouse http://www.jamwarehouse.com
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @version $Revision: 1.8 $
 * @author Mukhtar Dharsey, Jam Warehouse (Pty) Ltd, South Africa
 * @package administration.docfieldmanagement
 */
require_once("../../../../../config/dmsDefaults.php");
require_once("$default->fileSystemRoot/lib/visualpatterns/PatternListBox.inc");
require_once("$default->fileSystemRoot/lib/visualpatterns/PatternCreate.inc");
require_once("$default->fileSystemRoot/lib/security/Permission.inc");
require_once("$default->fileSystemRoot/lib/visualpatterns/PatternCustom.inc");	
require_once("$default->fileSystemRoot/lib/foldermanagement/Folder.inc");
require_once("$default->fileSystemRoot/presentation/lookAndFeel/knowledgeTree/foldermanagement/folderUI.inc");
require_once("$default->fileSystemRoot/presentation/Html.inc");
require_once("$default->fileSystemRoot/presentation/lookAndFeel/knowledgeTree/administration/adminUI.inc");
require_once("addDocFieldUI.inc");

if (checkSession()) {
	require_once("$default->fileSystemRoot/presentation/webpageTemplate.inc");			
	$oPatternCustom = & new PatternCustom();
	$oPatternCustom->setHtml(getPage());
	$main->setCentralPayload($oPatternCustom);
	$main->setFormAction("$default->rootUrl/presentation/lookAndFeel/knowledgeTree/create.php?fRedirectURL=".urlencode("$default->rootUrl/control.php?action=addDocFieldSuccess&fFromCreate=1&fDocFieldID="));
    $main->setHasRequiredFields(true);
	$main->render();
}
?>