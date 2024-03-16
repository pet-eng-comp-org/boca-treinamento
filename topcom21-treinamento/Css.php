<?php
////////////////////////////////////////////////////////////////////////////////
//BOCA Online Contest Administrator
//    Copyright (C) 2003-2012 by BOCA Development Team (bocasystem@gmail.com)
//
//    This program is free software: you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation, either version 3 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//    You should have received a copy of the GNU General Public License
//    along with this program.  If not, see <http://www.gnu.org/licenses/>.
////////////////////////////////////////////////////////////////////////////////
// Last modified 05/aug/2012 by cassio@ime.usp.br
$corfundo = "#F2ECD5";
$corfrente = "#FEFFFF";
$corfundo2 = "#2b7a78";
$cormenu = "#17252a";
$corred = "#ff0000";
$corverdinho = "#3abfa9";
?>
.login-table{
  background-color: <?php echo $corfrente; ?>;
 /* background-image: radial-gradient(#3aafa9,#3aafa9, #349d98, #2e8c87, #226965 ,#1d5754);*/
  padding: 2em;
  border-radius: 1em;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}
.login-button{
  border: 0;
  color: #fff;
  font-weight: bold;
  background-color: #2f2f32;
  border-radius: 1em;
  margin-top: 0.8em;
  margin-bottom: 0.2em;
  padding: 0.4em 1.5em;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

#conteudo-1 {
    float:left;
    width:240px;
}
#conteudo-2 {
    float:right;
}

#conteudo-2-1 {
    float:left;
}
#conteudo-2-2 {
    float:right;
    width:240px;
}

.warning {
  background-color: <?php echo $corred; ?>;
  padding: 0.5em 1em;
  border-radius: 1em;
}

.other-button{
  border: 0;
  color: black;
  background-color: <?php echo $corfrente; ?>;
  border-radius: 1em;
  margin-top: 0.8em;
  margin-bottom: 0.2em;
  padding: 0.4em 1.5em;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}


.judge-table{
    margin-top: 15px;
    width: 100%;
    overflow:hidden;
    border=0;         
    background-color:#17252a; 
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    font-weight:bold;
}

td {
  color: #2f2f32;
}

a {
  color: #2f2f32;
}

b {
  color: #2f2f32;
}


.header-table{
  margin-top: 15px;
  width: 100%;
  overflow:hidden;  
    border-collapse:separate;
    border: solid #ccc 1px;
    -webkit-border-radius: 25px;
       -moz-border-radius: 25px;
            border-radius: 25px;
    background-color:#17252a; 
    box-shadow: 0 1px 4px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}



.run-table {
  margin-top: 15px;
    width: 100%;
    text-align: center;
    overflow:hidden;
    
}

.run-table td {
  background-color: <?php echo $corfrente; ?>;
  color: black !important;
  text-shadow: none !important;
  padding: 0.4em 0.2em;
} 

.run-table a {
  color: black !important;
}

.site-table {
  margin-top: 15px;
    text-align: center;
    overflow:hidden;
    
}

.site-table td {
  background-color: <?php echo $corfrente; ?>;
  color: black !important;
  text-shadow: none !important;
  padding: 0.4em 0.2em;
} 

.site-table th{
  width=100%; 
  border=0;
  background-color:#17252a;
  color: #FEFFFF !important; 
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
  font-weight:bold;
}

.site-table a {
  color: black !important;
}



.stat-table {
  margin-top: 15px;
    text-align: center;
    overflow:hidden;
    
}

.stat-table td {
  background-color: <?php echo $corfrente; ?>;
  color: black !important;
  text-shadow: none !important;
  padding: 0.4em 0.2em;
} 

.stat-table a {
  color: black !important;
}


.run-tableadm {
  margin-top: 15px;
    width: 100%;
    text-align: center;
    overflow:hidden;
    
}

.run-tableadm th{
  width=100%; 
  border=0;
  background-color:#17252a;
  color: #FEFFFF !important; 
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
  font-weight:bold;
}

.run-tableadm td {
  background-color: <?php echo $corfrente; ?>;
  color: black !important;
  text-shadow: none !important;
  padding: 0.4em 0.2em;
} 

.run-tableadm a {
  color: #a9a9a9;
}



.judedit-table {
  margin-top: 15px;
    text-align: center;
    overflow:hidden;
    
}

.judedit-table td {
  background-color: <?php echo $corfrente; ?>;
  color: black !important;
  text-shadow: none !important;
  padding: 0.4em 0.2em;
} 

.judedit-table a {
  color: black;
}


.judedit2-table {
  margin-top: 15px;
    text-align: center;
    overflow:hidden;
    
}

.judedit2-table td {
  background-color: <?php echo $corfrente; ?>;
  color: black;
  text-shadow: none !important;
  padding: 0.4em 0.2em;
} 

.judedit2-table a {
  color: black;
}




.task-table {
  margin-top: 15px;
    width: 100%;
    text-align: center;
    overflow:hidden;
    
}

.task-table td {
  background-color: <?php echo $corfrente; ?>;
  color: black !important;
  text-shadow: none !important;
  padding: 0.4em 0.2em;
} 

.task-table a {
  color: black !important;
} 



.foguete {
  clear: both;
  transform: rotate(270deg);
  animation-duration: 20s;
  animation-name: slidein;
  animation-iteration-count: infinite;
}

@keyframes slidein {
  from {
    margin-left: 200%;
    width: 200px;
    rotate: 90;
  }

  to {
    margin-left: -200%;
    width: 200px;
  }
}


.text-focus-in{animation:text-focus-in 1s cubic-bezier(.55,.085,.68,.53) both}

@keyframes text-focus-in{0%{filter:blur(12px);opacity:0}100%{filter:blur(0);opacity:1}}

input:focus {
    border: 1px solid #FFA500;
	background-color: #FFFACD;
}

.login-input{
	width: 100%;
	text-align: center;
	font-family: Verdana;
	border-radius: 1em;
}


a.menu{
  color: #2f2f32 !important;
}

a.menu2{
  color: black;
}


div#popupnew {
position:absolute;
left:50%;
top:17%;
margin-left:-202px;
font-family:'Raleway',sans-serif
}
div#normal {
width:100%;
height:100%;
opacity:.95;
top:0;
left:0;
display:none;
position:fixed;
background-color:#313132;
overflow:auto
}
DIV.menu {background-color:<?php echo $corfundo?>; layer-background-color:<?php echo $corfundo?>}
DIV.menudown {background-color:<?php echo $cormenu?>; border-bottom:1px solid white; border-right:1px solid white;border-top:2px solid #555555;border-left:1px solid #555555}
DIV.menu2 {background-color:<?php echo $corfundo?>; color: white !important; layer-background-color:<?php echo $corfundo?>}
DIV.fname {background-color:<?php echo $corfundo2?>; layer-background-color:<?php echo $corfundo2?>; position:absolute; visibility:hidden; border:0; left:0px; top:0px; height:19px; z-index:100;}
DIV.dir {background-color:<?php echo $corfundo?>; layer-background-color:<?php echo $corfundo?>; position:absolute; visibility:hidden; border:0; left:0px; top:0px; height:19px;z-index:100; }
A {font-family:"Courier New", Courier, mono; font-size:12pt; color: #2f2f32} 
A.header {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12pt} 
A.menu {font-family:Verdana, Arial, Helvetica, sans-serif; text-decoration:none; font-size:12pt; border: 1px solid <?php echo $corfundo?>} 
A.menu:hover {background-color: #fff; border-bottom:1px solid #555555; border-right:1px solid #555555;border-top:1px solid white;border-left:1px solid white} 
A.menu2 {font-family:Verdana, Arial, Helvetica, sans-serif; text-decoration:none; font-size:12pt; border: 1px solid <?php echo $corfundo?>} 
A.menu2:hover {background-color:<?php echo $cormenu?>; border-bottom:1px solid #555555; border-right:1px solid #555555;border-top:1px solid white;border-left:1px solid white} 
A.user {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12pt} 
A.user:hover {font-weight: bolder} 
A.disabled {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12pt; text-decoration:none; color:#BFBFBF} 
A.form {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12pt; background-color:<?php echo $cormenu?>} 
BODY {overflow-x: scroll ;background-color:<?php echo $corfundo?>; font-family:"Courier new", monospace; font-size:12pt; color:<?php echo $corfrente?>} 
BODY.cline {background-color:#000000; color:#2f2f32}
TABLE { font-family:"Courier New", Courier, mono; font-size:12pt } 
TABLE.form { font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12pt } 
FORM { font-size:12pt;} 
FORM.alt { font-size:12pt; margin-top: 5px } 
FORM.fname { font-size:12pt; margin: 0px} 
INPUT.fname { font-family:"Courier New", Courier, mono;font-size:12pt; border:0; background-color:<?php echo $corfundo2?> }
FORM.dir { font-size:12pt; margin: 0px} 
INPUT.dir { font-family:"Courier New", Courier, mono;font-size:12pt; border:0; background-color:<?php echo $corfundo?> }
<?php if( strstr(getenv("HTTP_USER_AGENT"), "MSIE")) { ?>
input.checkbox { border:none }
<?php } else { ?>
input.checkbox { }
<?php } ?>
INPUT { font-size:12pt; border:1px solid #555555}
INPUT.cline { background-color:#000000; font-family:"Courier new", monospace; font-size:12pt; color:#2f2f32; border:0} 
TEXTAREA { border:1px solid #555555 }
TEXTAREA.edit { font-family:"Courier New", Courier, mono;font-size:10pt; background-color:#2f2f32 } 
SELECT { font-size:12pt;}
p.link a:hover {background-color: #2B2E21;;color:#2f2f32;}
p.link a:link span{display: none;}
p.link a:visited span{display: none;}
p.link a:hover span {
  position: absolute;
  margin:15px 0px 0px 20px;
  background-color: beige;
  max-width:220;
  padding: 2px 10px 2px 10px;
  border: 1px solid #C0C0C0;
  font: normal 10px/12px verdana;
  color: #000;
  text-align:left;
  display: block;
}
<?php for($i=1;$i<999;$i++) echo "table.sitehide$i .sitegroup$i { display: none; }\n"; ?>

