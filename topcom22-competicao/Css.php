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
$corfundo = "#e0e0d0";
$corfrente = "#000000";
$corfundo2 = "#dfdfdf";
$cormenu = "#dfdfdf";
?>
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
background-color:#313131;
overflow:auto
}
/* ==================== LOGIN PAGE ==================== */

.loginContainer {
  width: 475px;
  position: absolute;
  right: 120px;
}

.loginContainer form{
  width: 100%;
  height: 32rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  border-radius: 8px;
  background-color: rgba(100, 100, 100, 0.7 );
  -webkit-backdrop-filter: blur(10px);
  backdrop-filter: blur(10px); 
}

.loginContainer input[type='text'], .loginContainer input[type='password'] {
  height: 3rem;
  padding: 1rem;
  border: none;
  margin-bottom: 1rem;
  outline: none;
  border-bottom: 4px solid <?php echo $primary?>;
  background-color: transparent;
  padding-bottom: 1px;
  color: black;
  text-align: center;
  transition: .5s;
}
.loginContainer form img{
  margin-bottom: 30px;
}

.loginContainer input:focus-visible {
  border-bottom: 4px solid <?php echo $secondary?>;
}

.loginContainer input::placeholder {
  color: black;
  text-transform: uppercase;
  
}

.loginContainer input[type='submit'] {
  height: 2rem;
  width: 6rem;
  text-transform: uppercase;
  font-weight: bold;
  background-color: #098936;
  border: none;
  border-radius: 8px;
  color: <?php echo $quinquernary?>;
  cursor: pointer;
  border: 1px solid transparent;
  margin: 3rem 0;
  transition: .5s;
}

.loginContainer input[type='submit']:hover{
  background-color: <?php echo $secondary?>;
  box-shadow: 0px 5px <?php echo $quinquernary?>;
}

.loginContainer input:hover {
  transform: translateY(-5px);
  box-shadow: 0px 5px <?php echo $quinquernary?>;
}

.loginContainer img {
  width: 30%;
}

#loginTableContainer {
  
  display: flex;
  justify-content: end;
  align-items: center;
  padding: 40px;
  max-width: 30rem;
  height: 90%;
}

/* ==================== SYSTEM PAGE ==================== */

.systemContestForm {
  width: 50%;
  margin: auto;
  padding: 10px;
  border-radius: 8px;
}

.systemContestForm center table {
  color: white;
  border: none;
  padding-bottom: 2rem;
}

.systemContestForm center {
  color: white;
}

/* ==================== OPTIONS FORM ==================== */

.allOptionsForm {
  width: 50%;
  margin: auto;
  padding: 10px;
  border-radius: 8px;
}

.allOptionsForm center table {
  color: white;
  border: none;
  padding-bottom: 2rem;
}

.allOptionsForm center {
  color: white;
}


/* ==================== HEADER NAVBAR ==================== */

.allHeaderTable {
  background-color: #1ed760;
  border-radius: 0;
  border: none;
}

.judge1HeaderTable {}
.judge2HeaderTable {}
.judgeBossHeaderTable {}
.adminHeaderTable {}
.systemHeaderTable {}

/*.scoreHeaderTable {
  background-color: #cc9966;
  border-radius: 0;
  border: none;
}*/

.allHeaderTable td table {
  border-radius: 0;
  border: none;
}

.allHeaderTable td {
  background: transparent;
  padding: 0 1rem;
  border: none;
  color: black;
  font-weight: bold;
}

/* ==================== RUN PAGE ==================== */

#paragraph {
  padding: 1rem 0;
  color: white;
  text-align: center;
}

DIV.menu {background-color:<?php echo $corfundo?>; layer-background-color:<?php echo $corfundo?>}
DIV.menudown {background-color:<?php echo $cormenu?>; border-bottom:1px solid white; border-right:1px solid white;border-top:2px solid #555555;border-left:1px solid #555555}
DIV.fname {background-color:<?php echo $corfundo2?>; layer-background-color:<?php echo $corfundo2?>; position:absolute; visibility:hidden; border:0; left:0px; top:0px; height:19px; z-index:100;}
DIV.dir {background-color:<?php echo $corfundo?>; layer-background-color:<?php echo $corfundo?>; position:absolute; visibility:hidden; border:0; left:0px; top:0px; height:19px;z-index:100; }

A {
  font-family:"Courier New", Courier, mono;
  font-size:12pt;
  color: white;
  font-weight: bold;
} 

B {
  color: white;
}

A.header {
  font-family:Verdana, Arial, Helvetica, sans-serif; 
  font-size:12pt
} 

A.menu {
  font-family:Verdana, Arial, Helvetica, sans-serif;
  text-decoration:none;
  font-size:12pt;
  color: white;
  transition: .5s;
} 

A.menu:hover {
  color:<?php echo $primary?>;
} 

A.user {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12pt} 
A.user:hover {font-weight: bolder} 
A.disabled {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12pt; text-decoration:none; color:#BFBFBF} 
A.form {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12pt; background-color:<?php echo $cormenu?>} 
BODY {background-color:<?php echo $corfundo?>; font-family:"Courier new", monospace; font-size:12pt; color:<?php echo $corfrente?>} 
BODY.cline {background-color:#000000; color:#000000} 
TABLE { font-family:"Courier New", Courier, mono; font-size:12pt } 
TABLE.form { font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12pt } 
FORM { font-size:12pt;} 
FORM.alt { font-size:12pt; margin-top: 5px } 
FORM.fname { font-size:12pt; margin: 0px} 
INPUT.fname { font-family:"Courier New", Courier, mono;font-size:12pt; border:0; background-color:<?php echo $corfundo2?> }
FORM.dir { font-size:12pt; margin: 0px} 
INPUT.dir { font-family:"Courier New", Courier, mono;font-size:12pt; border:0; background-color:<?php echo $corfundo?>; }




TABLE {
  font-family:"Courier New", Courier, mono;
  font-size:12pt; 
  margin: auto auto;
  color: white;
  border: none;
  backdrop-filter: blur(20px);
  background-color: transparent;
  background-color:rgba(33,32,30,.6);
}

TD {
  color: white;
  border: none;
  outline: none;
  padding: 5px;
}

INPUT {
  font-size:12pt;
  border:1px solid #555555;
  border-radius: 5px;
  height: 2rem;
}

center a.menu {
  color: white;
}

center {
  color: black;
}

.radius {
  border-radius: 8px;
}

INPUT[type='submit'], INPUT[type='reset'] {
  height: 2rem;
  /* width: 6rem; */
  padding: 5px 1rem;
  text-transform: uppercase;
  font-weight: bold;
  background-color: #098936;
  border: none;
  border-radius: 8px;
  color: black;
  cursor: pointer;
  border: 1px solid transparent;
  margin: 3rem 0;
  transition: .5s;
}

INPUT[type='submit']:hover, INPUT[type='reset']:hover{
  background-color: #11aa46;
  box-shadow: 0px 5px gray;
  transform: translateY(-5px);
  box-shadow: 0px 5px gray;
}

INPUT.cline { background-color:#000000; font-family:"Courier new", monospace; font-size:12pt; color:#FFFFFF; border:0} 
TEXTAREA { border:1px solid #555555; border-radius: 5px; }
TEXTAREA.edit { font-family:"Courier New", Courier, mono;font-size:10pt; background-color:#EFEFEF } 
SELECT { font-size:12pt;}
p.link a:hover {background-color: #2B2E21;;color:#fff;}
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


/* ==================== BODY ==================== */


.translucidTable {
  backdrop-filter: blur(20px);
  background-color: transparent;
  background-color:rgba(33,32,30,.6);
  border: 1px solid white; 
  color: white;
}

A.menu {
  font-family:Verdana, Arial, Helvetica, sans-serif; text-decoration:none;
  font-size:12pt;
  color: white;
}

BODY {
  position: relative;
  background-image:url("images/background.jpg");
  background-size: cover;
  background-attachment: fixed;
  background-repeat: no-repeat;
  backdrop-filter: brightness(100%);
  margin:0;
  color: white;
  font-family:"Courier new", monospace;
  font-size:12pt;

  /* font-weight: bold; */
  /* color: <?php echo $quaternary?> */
  /* background-color: <?php echo $quaternary?>;
}


