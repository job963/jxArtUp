<?php
/*
 *    This file is part of the module jxArtUp for OXID eShop Community Edition.
 *
 *    The module jxArtUp for OXID eShop Community Edition is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    The module jxArtUp for OXID eShop Community Edition is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      https://github.com/job963/jxArtUp
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @copyright (C) Joachim Barthel 2014-2016
 * 
 */

class jxArtUp_Install
{ 
    public static function onActivate() 
    { 

        $oDb = oxDb::getDb(); 

        $isUtf = oxRegistry::getConfig()->isUtf(); 
        $sCollate = ($isUtf ? "COLLATE 'utf8_general_ci'" : "");
        
        $aSql[] = "CREATE TABLE `jxarticleupdates` ("
                    . "`JXID` char(32) $sCollate DEFAULT NULL, "
                    . "`JXARTID` char(32) $sCollate DEFAULT NULL, "
                    . "`JXFIELD1` varchar(20) $sCollate DEFAULT NULL, "
                    . "`JXTYPE1` varchar(10) $sCollate DEFAULT NULL, "
                    . "`JXVALUE1` varchar(255) $sCollate DEFAULT NULL, "
                    . "`JXFIELD2` varchar(20) $sCollate DEFAULT NULL, "
                    . "`JXTYPE2` varchar(10) $sCollate DEFAULT NULL, "
                    . "`JXVALUE2` varchar(255) $sCollate DEFAULT NULL, "
                    . "`JXFIELD3` varchar(20) $sCollate DEFAULT NULL, "
                    . "`JXTYPE3` varchar(10) $sCollate DEFAULT NULL, "
                    . "`JXVALUE3` varchar(255) $sCollate DEFAULT NULL, "
                    . "`JXUPDATETIME` datetime DEFAULT NULL, "
                    . "`JXINHERIT` int(11) NOT NULL DEFAULT '0', "
                    . "`JXDONE` int(11) DEFAULT NULL, "
                    . "`JXTIMESTAMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"
                . ") "
                . "ENGINE=MyISAM DEFAULT " . ($isUtf ? ' CHARSET=utf8' : '');
        
        foreach ($aSql as $sSql) {
            try {
                $oRs = $oDb->Execute($sSql);
            }
            catch (Exception $e) {
                echo '<div style="border:2px solid #dd0000;margin:10px;padding:5px;background-color:#ffdddd;font-family:sans-serif;font-size:14px;">';
                echo '<b>SQL-Error '.$e->getCode().' in SQL statement</b><br />'.$e->getMessage().'';
                echo '</div>';
                return false;
                die();
            }
        }
        
        return true; 
    } 


    public static function onDeactivate() 
    { 
        /* do nothing */
        
        return true; 
    }  
}

?>