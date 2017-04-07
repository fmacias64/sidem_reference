<?php
/**
 * $Id: store.inc,v 1.8 2005/01/03 10:27:58 nbm Exp $
 *
 * Contains the logic for constructing queries from Pattern generated forms.
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
 * @author Rob Cherry, Jam Warehouse (Pty) Ltd, South Africa
 */

function constructQuery($aKeys, $aSuppliedValues = null) {
    $aQuery = array();
    for ($i = 0; $i < count($aKeys); $i++) {
        $sRowStart = $aKeys[$i];
        $pos = strncasecmp("unique_start", $sRowStart, 12);

        if ($pos == 0) {
            $sRandomString = substr($sRowStart, 13);
            if (!array_key_exists("pelfq_" . $sRandomString . "_tn", $_SESSION)) {
                print "Hack attempt!  Session data not set up for store.\n";
                return false;
            }
            if (!array_key_exists("pelfq_" . $sRandomString . "_id", $_SESSION)) {
                print "Hack attempt!  Session data not set up for store.\n";
                return false;
            }
            if (!array_key_exists("pelfq_" . $sRandomString . "_columns", $_SESSION)) {
                print "Hack attempt!  Session data not set up for store.\n";
                return false;
            }

            $aColumns = array();
            $aValues = array();
            $aTypes = array();

            // $iPrimaryKey = $_POST[$aKeys[++$i]];
            // $sTableName = $_POST[$aKeys[++$i]];
            $iPrimaryKey = $_SESSION["pelfq_" . $sRandomString . "_id"];
            $sTableName = $_SESSION["pelfq_" . $sRandomString . "_tn"];
            $aColumnNames = $_SESSION["pelfq_" . $sRandomString . "_columns"];

            $i++;
            $iColumnCount = 0;

            //get all the values for the table
            while ((strncasecmp("unique_end", $sRowStart, 10) != 0) && ($i <= count($aKeys)))  {
                //$aColumns[$iColumnCount] = $_POST[$aKeys[$i]];

                $sColumnName = $_POST[$aKeys[$i]];
                if (!in_array($sColumnName, $aColumnNames)) {
                    print "Hack attempt! $sColumnName is not in "; var_dump($aColumnNames);
                    return false;
                }
                // $aTypes[$iColumnCount]= $_POST[$aKeys[++$i]];

                $iType = $_POST[$aKeys[++$i]];

                switch ($iType) {
                    case 2:
                        //uncheck checkboxes don't generate any name/value pairs
                        //so if the next key doesn't contain the word "value" and it's type
                        //is checkbox, then we have an unchecked check box
                        if (strpos($aKeys[$i + 1], "value") === false) {
                            $mValue = false;
                        } else {
                            $i++;
                            $mValue = true;
                        }
                        //check box
                        break;
                    case 4:
                        $mValue = $aSuppliedValues[$sColumnName];
                        $i++;
                        break;
                    default:
                        $mValue = $_POST[$aKeys[++$i]];
                        break;
                }
                $aValues[$sColumnName] = $mValue;

                $sRowStart = $aKeys[++$i];
                $iColumnCount++;
            }

            if ($iPrimaryKey < 0) {
                //perform an insert
                // add query to array
                $id = DBUtil::autoInsert($sTableName, $aValues);
            } else {
                $res = DBUtil::autoUpdate($sTableName, $aValues, $iPrimaryKey);
            }
        }
    }
    return $aQuery;
}
?>