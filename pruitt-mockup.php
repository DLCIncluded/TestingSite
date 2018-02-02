<?PHP
include_once("dbConn.php");
include_once("accountManager.php");
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Permanent+Marker|Russo+One" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Coda" rel="stylesheet"> 
<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	  $('.login-button').click(function() {
		$('.login-form-wrap').slideToggle(400);
		console.log("Done")
	  });
	});
</script>
<style type="text/css">
/*  font-family: 'Permanent Marker', cursive;
    font-family: 'Russo One', sans-serif;
	*/

/* http://meyerweb.com/eric/tools/css/reset/ 
   v2.0 | 20110126
   License: none (public domain)
*/

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	padding:0;
	margin:0;
	height: 100%;
	width: 100%;
	color:#9d9d9d;
	background-color:#111111;
	font-family: 'Coda', cursive;
	line-height: 1;
	position: relative;
	z-index: 0;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}

h1 { font-size: 2em; }
h2 { font-size: 1.5em; }
h3 { font-size: 1.17em; }
h4 { font-size: 1.12em; }
h5 { font-size: .83em; }
h6 { font-size: .75em; }





#container{
	width:80%;
	margin: 0 auto;
}
header{
	margin-top:0px;
	height:90px;
	line-height: 90px;
}
header h1 {
	font-family: 'Permanent Marker', cursive;
}
#sidebar-left{
/*	height:auto;
	width:200px;*/
	width: 25%;
	float:left;
}
ul, li {
	list-style:none;
	padding-left:0px;
}
#main-content{
	width: 50%;
/*	height:auto;
	 width:960px;*/
	float:left;
}
#main-content > h1 {
	font-family: 'Permanent Marker', cursive;
	margin-top:0px;
}
#sidebar-right{
	height:auto;
	width: 25%;
	/*width:200px;*/
	float:right;
}
#sidebar-right2{
	height:auto;
	width:200px;
	float:left;
}

a {
	text-decoration:none;
}

#dlc {
	float:left;
}
/*
#login-button{
	float:right;
	border:1px solid purple;
	width:75px;
	height:30px;
	text-align:center;
	padding-top:5px;
	display:block;
}*/

#login-button  {
	float:right;
    background-color: #9D9D9D;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    z-index: 99999;
}

#login-button:hover {
    background-color: #6f6f6f;
    color: white;
    padding: 10px 20px;
    text-align: center;
    display: inline-block;
}

a, a:visited {
	color:#00F2FF;
}

a:hover {
	color:#005EFF;
}

#clear{
	content: "";
	display: table;
	clear: both;
}
.login-form-wrap {
	width: 100%;
  	background-color: #1e1e1e;
  	display: none;
  	border-bottom: 1px solid #5bc1ff;
}
.login-form-container {
	width: 800px;
	margin: 0 auto;
	line-height: 80px;
	overflow: hidden;
}
#login-form-dropdown {
	height:80px;
	width:100%;
	margin: 0 auto;
	text-transform: Uppercase;
	text-align:center;
	z-index: 88;
}

#login-form input {
	height: 40px;
	line-height: 40px;
	border: none;
	border-bottom: 2px solid #5bc1ff;
	background: transparent;
	padding: 0 10px;
	margin-right: 5px;

}

.stars-container {
	min-width: 100%;
	min-height: 100%;
	overflow: hidden;
	position: absolute;
	top: 0;
	left: 0;
	z-index: -99999;
}

#stars {
  width: 1px;
  height: 1px;
  background: transparent;
  box-shadow: 122px 1631px #FFF , 1655px 1982px #FFF , 1576px 1081px #FFF , 355px 844px #FFF , 384px 1048px #FFF , 288px 1502px #FFF , 226px 462px #FFF , 1231px 9px #FFF , 1514px 1703px #FFF , 1997px 902px #FFF , 1623px 624px #FFF , 796px 1879px #FFF , 187px 1511px #FFF , 224px 302px #FFF , 682px 581px #FFF , 696px 1626px #FFF , 957px 1090px #FFF , 1858px 333px #FFF , 667px 1328px #FFF , 14px 1540px #FFF , 1558px 797px #FFF , 762px 1795px #FFF , 1754px 725px #FFF , 235px 616px #FFF , 27px 1392px #FFF , 1611px 1063px #FFF , 936px 1459px #FFF , 328px 1101px #FFF , 1221px 998px #FFF , 611px 841px #FFF , 1768px 1565px #FFF , 786px 1335px #FFF , 1819px 242px #FFF , 121px 614px #FFF , 467px 256px #FFF , 1403px 353px #FFF , 1634px 774px #FFF , 654px 397px #FFF , 1438px 194px #FFF , 1638px 507px #FFF , 907px 1734px #FFF , 1731px 201px #FFF , 478px 51px #FFF , 1113px 1338px #FFF , 1418px 1592px #FFF , 419px 667px #FFF , 1374px 812px #FFF , 459px 1937px #FFF , 1687px 637px #FFF , 601px 870px #FFF , 1646px 1269px #FFF , 1185px 1173px #FFF , 1896px 1472px #FFF , 1717px 561px #FFF , 1830px 911px #FFF , 1431px 317px #FFF , 710px 152px #FFF , 1772px 2000px #FFF , 987px 1264px #FFF , 1386px 1495px #FFF , 1985px 737px #FFF , 1171px 523px #FFF , 270px 69px #FFF , 920px 1430px #FFF , 1421px 446px #FFF , 528px 53px #FFF , 1432px 119px #FFF , 1836px 1388px #FFF , 555px 350px #FFF , 1323px 385px #FFF , 86px 1601px #FFF , 10px 1862px #FFF , 1706px 628px #FFF , 1267px 263px #FFF , 857px 1088px #FFF , 975px 1529px #FFF , 1531px 766px #FFF , 367px 185px #FFF , 200px 525px #FFF , 1209px 1239px #FFF , 216px 295px #FFF , 1143px 526px #FFF , 1000px 1232px #FFF , 905px 1048px #FFF , 1079px 975px #FFF , 483px 1688px #FFF , 63px 598px #FFF , 995px 1294px #FFF , 1223px 1986px #FFF , 835px 265px #FFF , 382px 671px #FFF , 662px 1932px #FFF , 1891px 260px #FFF , 120px 1353px #FFF , 158px 227px #FFF , 1272px 318px #FFF , 1001px 558px #FFF , 762px 1369px #FFF , 1525px 249px #FFF , 1340px 1658px #FFF , 136px 1097px #FFF , 796px 1353px #FFF , 1877px 1802px #FFF , 1087px 1621px #FFF , 955px 1817px #FFF , 961px 43px #FFF , 1235px 977px #FFF , 278px 1176px #FFF , 1141px 1889px #FFF , 1171px 1623px #FFF , 1172px 1479px #FFF , 1547px 1367px #FFF , 879px 1010px #FFF , 734px 208px #FFF , 925px 1972px #FFF , 119px 1776px #FFF , 1866px 1062px #FFF , 548px 337px #FFF , 1794px 276px #FFF , 283px 1808px #FFF , 491px 266px #FFF , 122px 1756px #FFF , 1883px 1196px #FFF , 901px 965px #FFF , 1939px 1215px #FFF , 1592px 262px #FFF , 1854px 1769px #FFF , 436px 174px #FFF , 724px 717px #FFF , 834px 1539px #FFF , 515px 983px #FFF , 581px 969px #FFF , 574px 332px #FFF , 1732px 577px #FFF , 1385px 1630px #FFF , 1476px 1765px #FFF , 1219px 991px #FFF , 1370px 1548px #FFF , 999px 1553px #FFF , 918px 647px #FFF , 1929px 1844px #FFF , 1737px 164px #FFF , 1293px 488px #FFF , 1705px 469px #FFF , 419px 252px #FFF , 1359px 667px #FFF , 1432px 988px #FFF , 882px 903px #FFF , 1138px 392px #FFF , 1178px 1305px #FFF , 1272px 813px #FFF , 1923px 1560px #FFF , 1397px 1701px #FFF , 1335px 878px #FFF , 495px 561px #FFF , 741px 91px #FFF , 202px 1050px #FFF , 1012px 1004px #FFF , 1267px 962px #FFF , 1491px 1891px #FFF , 2px 924px #FFF , 570px 1169px #FFF , 1874px 1320px #FFF , 543px 1154px #FFF , 869px 330px #FFF , 99px 465px #FFF , 172px 746px #FFF , 1114px 423px #FFF , 987px 1226px #FFF , 1221px 1932px #FFF , 732px 1463px #FFF , 712px 1797px #FFF , 920px 1344px #FFF , 1278px 1165px #FFF , 869px 1069px #FFF , 1043px 333px #FFF , 953px 1929px #FFF , 861px 271px #FFF , 1495px 663px #FFF , 812px 912px #FFF , 1181px 116px #FFF , 457px 919px #FFF , 1512px 1468px #FFF , 393px 550px #FFF , 308px 980px #FFF , 8px 292px #FFF , 1139px 1983px #FFF , 1677px 300px #FFF , 1255px 1209px #FFF , 973px 2px #FFF , 643px 1354px #FFF , 650px 816px #FFF , 394px 864px #FFF , 1698px 685px #FFF , 373px 1333px #FFF , 323px 437px #FFF , 1005px 158px #FFF , 90px 1484px #FFF , 1518px 687px #FFF , 212px 1428px #FFF , 942px 208px #FFF , 9px 1985px #FFF , 309px 83px #FFF , 408px 1691px #FFF , 734px 449px #FFF , 11px 1425px #FFF , 1744px 1785px #FFF , 218px 1560px #FFF , 1211px 1886px #FFF , 856px 1549px #FFF , 751px 971px #FFF , 720px 970px #FFF , 1045px 1352px #FFF , 1438px 824px #FFF , 1341px 576px #FFF , 426px 981px #FFF , 53px 1401px #FFF , 1650px 1818px #FFF , 85px 1069px #FFF , 466px 1101px #FFF , 619px 607px #FFF , 704px 447px #FFF , 259px 1219px #FFF , 1861px 405px #FFF , 982px 1176px #FFF , 168px 1008px #FFF , 1662px 1389px #FFF , 1621px 1375px #FFF , 1986px 1856px #FFF , 1943px 1532px #FFF , 1143px 1065px #FFF , 1970px 745px #FFF , 1631px 957px #FFF , 1719px 591px #FFF , 1940px 291px #FFF , 694px 1762px #FFF , 1887px 1363px #FFF , 406px 259px #FFF , 1648px 1143px #FFF , 1539px 1513px #FFF , 1837px 329px #FFF , 1726px 1692px #FFF , 1271px 1421px #FFF , 741px 1408px #FFF , 1219px 952px #FFF , 1401px 1399px #FFF , 1626px 795px #FFF , 641px 341px #FFF , 182px 1811px #FFF , 1931px 1507px #FFF , 872px 187px #FFF , 1474px 1987px #FFF , 30px 272px #FFF , 1644px 1504px #FFF , 1749px 986px #FFF , 847px 1975px #FFF , 502px 1287px #FFF , 1691px 848px #FFF , 1865px 1833px #FFF , 1459px 1619px #FFF , 1362px 543px #FFF , 1230px 1533px #FFF , 1301px 662px #FFF , 1078px 703px #FFF , 939px 1792px #FFF , 1778px 981px #FFF , 554px 734px #FFF , 1621px 1696px #FFF , 1944px 1893px #FFF , 735px 992px #FFF , 1343px 1243px #FFF , 895px 1836px #FFF , 1162px 1508px #FFF , 1336px 878px #FFF , 91px 1377px #FFF , 1366px 753px #FFF , 416px 1901px #FFF , 698px 1964px #FFF , 125px 115px #FFF , 577px 198px #FFF , 98px 1655px #FFF , 1021px 263px #FFF , 1614px 1766px #FFF , 1239px 1533px #FFF , 1420px 104px #FFF , 186px 440px #FFF , 1372px 1206px #FFF , 1037px 1401px #FFF , 739px 1273px #FFF , 746px 1687px #FFF , 1900px 1373px #FFF , 1342px 1449px #FFF , 926px 115px #FFF , 1185px 1138px #FFF , 986px 1936px #FFF , 267px 170px #FFF , 64px 853px #FFF , 1306px 25px #FFF , 451px 1717px #FFF , 661px 355px #FFF , 1400px 146px #FFF , 87px 68px #FFF , 1835px 1513px #FFF , 881px 1564px #FFF , 1172px 844px #FFF , 1994px 682px #FFF , 1364px 1472px #FFF , 1089px 529px #FFF , 1525px 481px #FFF , 642px 1543px #FFF , 1560px 927px #FFF , 359px 417px #FFF , 372px 1119px #FFF , 1125px 509px #FFF , 1043px 583px #FFF , 1325px 1712px #FFF , 1386px 841px #FFF , 1860px 1692px #FFF , 508px 941px #FFF , 1497px 1341px #FFF , 1764px 529px #FFF , 112px 189px #FFF , 1682px 920px #FFF , 1035px 1460px #FFF , 1345px 31px #FFF , 1643px 1658px #FFF , 1169px 1576px #FFF , 1485px 604px #FFF , 823px 821px #FFF , 689px 1088px #FFF , 746px 783px #FFF , 671px 1214px #FFF , 237px 159px #FFF , 1637px 1398px #FFF , 83px 1484px #FFF , 1145px 1623px #FFF , 1103px 770px #FFF , 1949px 648px #FFF , 8px 867px #FFF , 1290px 688px #FFF , 447px 1311px #FFF , 1700px 746px #FFF , 659px 1894px #FFF , 579px 310px #FFF , 725px 1230px #FFF , 138px 479px #FFF , 731px 703px #FFF , 978px 710px #FFF , 1143px 1802px #FFF , 590px 1575px #FFF , 1636px 1532px #FFF , 1449px 273px #FFF , 1415px 1595px #FFF , 1036px 588px #FFF , 1153px 1712px #FFF , 335px 1893px #FFF , 292px 262px #FFF , 1819px 1226px #FFF , 574px 1813px #FFF , 1572px 500px #FFF , 1028px 254px #FFF , 707px 702px #FFF , 541px 1915px #FFF , 60px 995px #FFF , 1388px 317px #FFF , 1074px 46px #FFF , 1752px 1946px #FFF , 947px 481px #FFF , 752px 158px #FFF , 1581px 630px #FFF , 1196px 1788px #FFF , 298px 1513px #FFF , 1656px 86px #FFF , 1112px 924px #FFF , 584px 1609px #FFF , 1411px 839px #FFF , 519px 850px #FFF , 1840px 3px #FFF , 1278px 1622px #FFF , 1040px 214px #FFF , 1520px 628px #FFF , 465px 413px #FFF , 1632px 1106px #FFF , 454px 596px #FFF , 1116px 1019px #FFF , 1593px 755px #FFF , 1182px 1908px #FFF , 310px 1127px #FFF , 1925px 1510px #FFF , 739px 184px #FFF , 398px 1149px #FFF , 1759px 316px #FFF , 781px 1906px #FFF , 298px 1739px #FFF , 1171px 112px #FFF , 1832px 998px #FFF , 987px 704px #FFF , 1674px 1478px #FFF , 1250px 1770px #FFF , 1724px 1166px #FFF , 1454px 260px #FFF , 1558px 1877px #FFF , 1330px 275px #FFF , 491px 1887px #FFF , 835px 37px #FFF , 1372px 1249px #FFF , 1120px 1488px #FFF , 1819px 1534px #FFF , 407px 1227px #FFF , 1058px 172px #FFF , 760px 1654px #FFF , 1367px 197px #FFF , 1918px 685px #FFF , 473px 950px #FFF , 756px 325px #FFF , 1865px 1843px #FFF , 1752px 251px #FFF , 438px 985px #FFF , 1280px 1553px #FFF , 798px 179px #FFF , 364px 1994px #FFF , 1342px 338px #FFF , 567px 826px #FFF , 792px 1678px #FFF , 1711px 767px #FFF , 1581px 1563px #FFF , 1095px 1793px #FFF , 516px 411px #FFF , 1074px 1044px #FFF , 1594px 1334px #FFF , 751px 1229px #FFF , 294px 849px #FFF , 907px 443px #FFF , 1370px 908px #FFF , 245px 554px #FFF , 1983px 1367px #FFF , 1084px 354px #FFF , 818px 1146px #FFF , 1368px 766px #FFF , 1128px 638px #FFF , 1917px 531px #FFF , 1060px 334px #FFF , 801px 1269px #FFF , 1510px 860px #FFF , 1094px 657px #FFF , 1829px 1125px #FFF , 105px 1640px #FFF , 244px 342px #FFF , 939px 1989px #FFF , 193px 696px #FFF , 210px 1665px #FFF , 948px 1949px #FFF , 487px 354px #FFF , 1812px 1020px #FFF , 744px 241px #FFF , 1964px 1816px #FFF , 700px 1162px #FFF , 1673px 357px #FFF , 663px 1240px #FFF , 1287px 262px #FFF , 1509px 705px #FFF , 1962px 1426px #FFF , 1034px 68px #FFF , 1743px 296px #FFF , 889px 1510px #FFF , 1387px 1668px #FFF , 1772px 988px #FFF , 267px 1818px #FFF , 227px 1727px #FFF , 301px 188px #FFF , 1292px 660px #FFF , 1296px 1409px #FFF , 129px 1161px #FFF , 1709px 1818px #FFF , 642px 669px #FFF , 1250px 317px #FFF , 1310px 243px #FFF , 1168px 1670px #FFF , 248px 5px #FFF , 112px 101px #FFF , 1788px 959px #FFF , 125px 416px #FFF , 344px 588px #FFF , 273px 1817px #FFF , 126px 1229px #FFF , 1779px 1825px #FFF , 1965px 1496px #FFF , 1723px 843px #FFF , 1347px 1192px #FFF , 1600px 369px #FFF , 111px 322px #FFF , 1742px 1998px #FFF , 783px 322px #FFF , 1568px 657px #FFF , 96px 895px #FFF , 1542px 787px #FFF , 657px 1214px #FFF , 1545px 857px #FFF , 1732px 1907px #FFF , 884px 955px #FFF , 1028px 400px #FFF , 906px 1721px #FFF , 1549px 373px #FFF , 846px 1851px #FFF , 411px 663px #FFF , 7px 929px #FFF , 1781px 1767px #FFF , 739px 1747px #FFF , 1695px 398px #FFF , 437px 1674px #FFF , 1858px 46px #FFF , 1335px 161px #FFF , 247px 1885px #FFF , 1834px 1838px #FFF , 1712px 1656px #FFF , 1024px 1318px #FFF , 422px 262px #FFF , 1795px 901px #FFF , 652px 1325px #FFF , 192px 755px #FFF , 331px 1331px #FFF , 57px 1108px #FFF , 985px 347px #FFF , 1969px 1874px #FFF , 1261px 1266px #FFF , 662px 1805px #FFF , 1428px 1850px #FFF , 859px 998px #FFF , 848px 753px #FFF , 1744px 187px #FFF , 294px 1480px #FFF , 1083px 1591px #FFF , 1750px 1971px #FFF , 1874px 1252px #FFF , 1203px 237px #FFF , 809px 1248px #FFF , 693px 1515px #FFF , 987px 984px #FFF , 624px 390px #FFF , 742px 1949px #FFF , 1664px 1401px #FFF , 1902px 1067px #FFF , 1px 48px #FFF , 1045px 459px #FFF , 217px 289px #FFF , 54px 666px #FFF , 501px 1738px #FFF , 710px 1641px #FFF , 639px 1673px #FFF , 1572px 597px #FFF , 537px 1035px #FFF , 1532px 1882px #FFF , 1567px 1948px #FFF , 814px 852px #FFF , 1601px 1439px #FFF , 812px 662px #FFF , 610px 1394px #FFF , 164px 1117px #FFF , 147px 1939px #FFF , 1711px 1236px #FFF , 801px 1100px #FFF , 41px 1995px #FFF , 1909px 1067px #FFF , 1045px 1607px #FFF , 234px 1469px #FFF , 611px 444px #FFF , 370px 1154px #FFF , 271px 58px #FFF , 865px 1164px #FFF , 1923px 1779px #FFF , 1152px 1647px #FFF , 1615px 862px #FFF , 1560px 1514px #FFF , 879px 841px #FFF , 1175px 1326px #FFF , 330px 1768px #FFF , 288px 1288px #FFF , 329px 1687px #FFF , 579px 988px #FFF , 1431px 300px #FFF , 1707px 1939px #FFF , 655px 97px #FFF , 459px 1860px #FFF , 14px 1505px #FFF , 1783px 1297px #FFF , 651px 1475px #FFF , 1397px 589px #FFF , 1038px 1777px #FFF , 653px 1028px #FFF , 1474px 1018px #FFF , 824px 1456px #FFF , 273px 1465px #FFF , 1620px 131px #FFF , 1226px 1359px #FFF , 1026px 1794px #FFF , 604px 348px #FFF , 1291px 734px #FFF , 1403px 60px #FFF , 1530px 338px #FFF , 1323px 212px #FFF , 418px 1525px #FFF , 619px 444px #FFF , 1534px 520px #FFF , 351px 802px #FFF , 1494px 1954px #FFF , 778px 424px #FFF , 962px 191px #FFF , 1600px 1056px #FFF , 966px 240px #FFF , 986px 1123px #FFF , 154px 1538px #FFF , 1273px 719px #FFF , 1089px 264px #FFF , 1763px 253px #FFF , 1557px 1493px #FFF , 918px 488px #FFF , 1293px 1867px #FFF , 1970px 1491px #FFF , 218px 494px #FFF , 32px 589px #FFF , 1158px 1993px #FFF , 875px 1573px #FFF , 1313px 913px #FFF , 418px 1126px #FFF , 826px 1284px #FFF , 486px 1623px #FFF , 310px 440px #FFF , 922px 364px #FFF , 497px 806px #FFF , 227px 1410px #FFF , 329px 861px #FFF , 1984px 2px #FFF , 1652px 1152px #FFF , 758px 150px #FFF , 515px 408px #FFF , 100px 1168px #FFF , 1672px 559px #FFF , 475px 345px #FFF , 22px 931px #FFF , 1830px 599px #FFF , 342px 749px #FFF , 1793px 1155px #FFF , 716px 1475px #FFF , 739px 1351px #FFF , 1038px 286px #FFF , 667px 1101px #FFF , 1123px 562px #FFF , 1256px 1225px #FFF , 1314px 873px #FFF , 137px 325px #FFF , 743px 1972px #FFF , 151px 1287px #FFF , 87px 567px #FFF , 1118px 147px #FFF , 1108px 1567px #FFF , 1596px 814px #FFF , 944px 585px #FFF , 568px 37px #FFF , 230px 1464px #FFF , 540px 57px #FFF , 683px 1507px #FFF , 210px 437px #FFF , 493px 363px #FFF , 895px 636px #FFF , 1752px 871px #FFF , 994px 1911px #FFF , 1901px 1567px #FFF , 21px 1291px #FFF , 724px 1863px #FFF , 1424px 439px #FFF , 998px 1861px #FFF , 189px 1231px #FFF , 1814px 1185px #FFF , 1023px 607px #FFF , 823px 160px #FFF , 1092px 1858px #FFF , 1724px 434px #FFF , 1690px 1756px #FFF , 644px 1533px #FFF , 1140px 1279px #FFF , 417px 1482px #FFF , 853px 440px #FFF , 720px 1041px #FFF , 1359px 183px #FFF , 889px 1419px #FFF , 836px 1571px #FFF , 1903px 1036px #FFF , 1989px 568px #FFF , 1792px 1866px #FFF , 1023px 1512px #FFF , 962px 1200px #FFF , 393px 185px #FFF , 1531px 1222px #FFF , 1488px 364px #FFF , 446px 1733px #FFF , 1169px 276px #FFF , 1908px 1609px #FFF , 34px 307px #FFF , 333px 645px #FFF , 385px 1878px #FFF;
  animation: animStar 50s linear infinite;
}
#stars:after {
  content: " ";
  position: absolute;
  top: 2000px;
  width: 1px;
  height: 1px;
  background: transparent;
  box-shadow: 122px 1631px #FFF , 1655px 1982px #FFF , 1576px 1081px #FFF , 355px 844px #FFF , 384px 1048px #FFF , 288px 1502px #FFF , 226px 462px #FFF , 1231px 9px #FFF , 1514px 1703px #FFF , 1997px 902px #FFF , 1623px 624px #FFF , 796px 1879px #FFF , 187px 1511px #FFF , 224px 302px #FFF , 682px 581px #FFF , 696px 1626px #FFF , 957px 1090px #FFF , 1858px 333px #FFF , 667px 1328px #FFF , 14px 1540px #FFF , 1558px 797px #FFF , 762px 1795px #FFF , 1754px 725px #FFF , 235px 616px #FFF , 27px 1392px #FFF , 1611px 1063px #FFF , 936px 1459px #FFF , 328px 1101px #FFF , 1221px 998px #FFF , 611px 841px #FFF , 1768px 1565px #FFF , 786px 1335px #FFF , 1819px 242px #FFF , 121px 614px #FFF , 467px 256px #FFF , 1403px 353px #FFF , 1634px 774px #FFF , 654px 397px #FFF , 1438px 194px #FFF , 1638px 507px #FFF , 907px 1734px #FFF , 1731px 201px #FFF , 478px 51px #FFF , 1113px 1338px #FFF , 1418px 1592px #FFF , 419px 667px #FFF , 1374px 812px #FFF , 459px 1937px #FFF , 1687px 637px #FFF , 601px 870px #FFF , 1646px 1269px #FFF , 1185px 1173px #FFF , 1896px 1472px #FFF , 1717px 561px #FFF , 1830px 911px #FFF , 1431px 317px #FFF , 710px 152px #FFF , 1772px 2000px #FFF , 987px 1264px #FFF , 1386px 1495px #FFF , 1985px 737px #FFF , 1171px 523px #FFF , 270px 69px #FFF , 920px 1430px #FFF , 1421px 446px #FFF , 528px 53px #FFF , 1432px 119px #FFF , 1836px 1388px #FFF , 555px 350px #FFF , 1323px 385px #FFF , 86px 1601px #FFF , 10px 1862px #FFF , 1706px 628px #FFF , 1267px 263px #FFF , 857px 1088px #FFF , 975px 1529px #FFF , 1531px 766px #FFF , 367px 185px #FFF , 200px 525px #FFF , 1209px 1239px #FFF , 216px 295px #FFF , 1143px 526px #FFF , 1000px 1232px #FFF , 905px 1048px #FFF , 1079px 975px #FFF , 483px 1688px #FFF , 63px 598px #FFF , 995px 1294px #FFF , 1223px 1986px #FFF , 835px 265px #FFF , 382px 671px #FFF , 662px 1932px #FFF , 1891px 260px #FFF , 120px 1353px #FFF , 158px 227px #FFF , 1272px 318px #FFF , 1001px 558px #FFF , 762px 1369px #FFF , 1525px 249px #FFF , 1340px 1658px #FFF , 136px 1097px #FFF , 796px 1353px #FFF , 1877px 1802px #FFF , 1087px 1621px #FFF , 955px 1817px #FFF , 961px 43px #FFF , 1235px 977px #FFF , 278px 1176px #FFF , 1141px 1889px #FFF , 1171px 1623px #FFF , 1172px 1479px #FFF , 1547px 1367px #FFF , 879px 1010px #FFF , 734px 208px #FFF , 925px 1972px #FFF , 119px 1776px #FFF , 1866px 1062px #FFF , 548px 337px #FFF , 1794px 276px #FFF , 283px 1808px #FFF , 491px 266px #FFF , 122px 1756px #FFF , 1883px 1196px #FFF , 901px 965px #FFF , 1939px 1215px #FFF , 1592px 262px #FFF , 1854px 1769px #FFF , 436px 174px #FFF , 724px 717px #FFF , 834px 1539px #FFF , 515px 983px #FFF , 581px 969px #FFF , 574px 332px #FFF , 1732px 577px #FFF , 1385px 1630px #FFF , 1476px 1765px #FFF , 1219px 991px #FFF , 1370px 1548px #FFF , 999px 1553px #FFF , 918px 647px #FFF , 1929px 1844px #FFF , 1737px 164px #FFF , 1293px 488px #FFF , 1705px 469px #FFF , 419px 252px #FFF , 1359px 667px #FFF , 1432px 988px #FFF , 882px 903px #FFF , 1138px 392px #FFF , 1178px 1305px #FFF , 1272px 813px #FFF , 1923px 1560px #FFF , 1397px 1701px #FFF , 1335px 878px #FFF , 495px 561px #FFF , 741px 91px #FFF , 202px 1050px #FFF , 1012px 1004px #FFF , 1267px 962px #FFF , 1491px 1891px #FFF , 2px 924px #FFF , 570px 1169px #FFF , 1874px 1320px #FFF , 543px 1154px #FFF , 869px 330px #FFF , 99px 465px #FFF , 172px 746px #FFF , 1114px 423px #FFF , 987px 1226px #FFF , 1221px 1932px #FFF , 732px 1463px #FFF , 712px 1797px #FFF , 920px 1344px #FFF , 1278px 1165px #FFF , 869px 1069px #FFF , 1043px 333px #FFF , 953px 1929px #FFF , 861px 271px #FFF , 1495px 663px #FFF , 812px 912px #FFF , 1181px 116px #FFF , 457px 919px #FFF , 1512px 1468px #FFF , 393px 550px #FFF , 308px 980px #FFF , 8px 292px #FFF , 1139px 1983px #FFF , 1677px 300px #FFF , 1255px 1209px #FFF , 973px 2px #FFF , 643px 1354px #FFF , 650px 816px #FFF , 394px 864px #FFF , 1698px 685px #FFF , 373px 1333px #FFF , 323px 437px #FFF , 1005px 158px #FFF , 90px 1484px #FFF , 1518px 687px #FFF , 212px 1428px #FFF , 942px 208px #FFF , 9px 1985px #FFF , 309px 83px #FFF , 408px 1691px #FFF , 734px 449px #FFF , 11px 1425px #FFF , 1744px 1785px #FFF , 218px 1560px #FFF , 1211px 1886px #FFF , 856px 1549px #FFF , 751px 971px #FFF , 720px 970px #FFF , 1045px 1352px #FFF , 1438px 824px #FFF , 1341px 576px #FFF , 426px 981px #FFF , 53px 1401px #FFF , 1650px 1818px #FFF , 85px 1069px #FFF , 466px 1101px #FFF , 619px 607px #FFF , 704px 447px #FFF , 259px 1219px #FFF , 1861px 405px #FFF , 982px 1176px #FFF , 168px 1008px #FFF , 1662px 1389px #FFF , 1621px 1375px #FFF , 1986px 1856px #FFF , 1943px 1532px #FFF , 1143px 1065px #FFF , 1970px 745px #FFF , 1631px 957px #FFF , 1719px 591px #FFF , 1940px 291px #FFF , 694px 1762px #FFF , 1887px 1363px #FFF , 406px 259px #FFF , 1648px 1143px #FFF , 1539px 1513px #FFF , 1837px 329px #FFF , 1726px 1692px #FFF , 1271px 1421px #FFF , 741px 1408px #FFF , 1219px 952px #FFF , 1401px 1399px #FFF , 1626px 795px #FFF , 641px 341px #FFF , 182px 1811px #FFF , 1931px 1507px #FFF , 872px 187px #FFF , 1474px 1987px #FFF , 30px 272px #FFF , 1644px 1504px #FFF , 1749px 986px #FFF , 847px 1975px #FFF , 502px 1287px #FFF , 1691px 848px #FFF , 1865px 1833px #FFF , 1459px 1619px #FFF , 1362px 543px #FFF , 1230px 1533px #FFF , 1301px 662px #FFF , 1078px 703px #FFF , 939px 1792px #FFF , 1778px 981px #FFF , 554px 734px #FFF , 1621px 1696px #FFF , 1944px 1893px #FFF , 735px 992px #FFF , 1343px 1243px #FFF , 895px 1836px #FFF , 1162px 1508px #FFF , 1336px 878px #FFF , 91px 1377px #FFF , 1366px 753px #FFF , 416px 1901px #FFF , 698px 1964px #FFF , 125px 115px #FFF , 577px 198px #FFF , 98px 1655px #FFF , 1021px 263px #FFF , 1614px 1766px #FFF , 1239px 1533px #FFF , 1420px 104px #FFF , 186px 440px #FFF , 1372px 1206px #FFF , 1037px 1401px #FFF , 739px 1273px #FFF , 746px 1687px #FFF , 1900px 1373px #FFF , 1342px 1449px #FFF , 926px 115px #FFF , 1185px 1138px #FFF , 986px 1936px #FFF , 267px 170px #FFF , 64px 853px #FFF , 1306px 25px #FFF , 451px 1717px #FFF , 661px 355px #FFF , 1400px 146px #FFF , 87px 68px #FFF , 1835px 1513px #FFF , 881px 1564px #FFF , 1172px 844px #FFF , 1994px 682px #FFF , 1364px 1472px #FFF , 1089px 529px #FFF , 1525px 481px #FFF , 642px 1543px #FFF , 1560px 927px #FFF , 359px 417px #FFF , 372px 1119px #FFF , 1125px 509px #FFF , 1043px 583px #FFF , 1325px 1712px #FFF , 1386px 841px #FFF , 1860px 1692px #FFF , 508px 941px #FFF , 1497px 1341px #FFF , 1764px 529px #FFF , 112px 189px #FFF , 1682px 920px #FFF , 1035px 1460px #FFF , 1345px 31px #FFF , 1643px 1658px #FFF , 1169px 1576px #FFF , 1485px 604px #FFF , 823px 821px #FFF , 689px 1088px #FFF , 746px 783px #FFF , 671px 1214px #FFF , 237px 159px #FFF , 1637px 1398px #FFF , 83px 1484px #FFF , 1145px 1623px #FFF , 1103px 770px #FFF , 1949px 648px #FFF , 8px 867px #FFF , 1290px 688px #FFF , 447px 1311px #FFF , 1700px 746px #FFF , 659px 1894px #FFF , 579px 310px #FFF , 725px 1230px #FFF , 138px 479px #FFF , 731px 703px #FFF , 978px 710px #FFF , 1143px 1802px #FFF , 590px 1575px #FFF , 1636px 1532px #FFF , 1449px 273px #FFF , 1415px 1595px #FFF , 1036px 588px #FFF , 1153px 1712px #FFF , 335px 1893px #FFF , 292px 262px #FFF , 1819px 1226px #FFF , 574px 1813px #FFF , 1572px 500px #FFF , 1028px 254px #FFF , 707px 702px #FFF , 541px 1915px #FFF , 60px 995px #FFF , 1388px 317px #FFF , 1074px 46px #FFF , 1752px 1946px #FFF , 947px 481px #FFF , 752px 158px #FFF , 1581px 630px #FFF , 1196px 1788px #FFF , 298px 1513px #FFF , 1656px 86px #FFF , 1112px 924px #FFF , 584px 1609px #FFF , 1411px 839px #FFF , 519px 850px #FFF , 1840px 3px #FFF , 1278px 1622px #FFF , 1040px 214px #FFF , 1520px 628px #FFF , 465px 413px #FFF , 1632px 1106px #FFF , 454px 596px #FFF , 1116px 1019px #FFF , 1593px 755px #FFF , 1182px 1908px #FFF , 310px 1127px #FFF , 1925px 1510px #FFF , 739px 184px #FFF , 398px 1149px #FFF , 1759px 316px #FFF , 781px 1906px #FFF , 298px 1739px #FFF , 1171px 112px #FFF , 1832px 998px #FFF , 987px 704px #FFF , 1674px 1478px #FFF , 1250px 1770px #FFF , 1724px 1166px #FFF , 1454px 260px #FFF , 1558px 1877px #FFF , 1330px 275px #FFF , 491px 1887px #FFF , 835px 37px #FFF , 1372px 1249px #FFF , 1120px 1488px #FFF , 1819px 1534px #FFF , 407px 1227px #FFF , 1058px 172px #FFF , 760px 1654px #FFF , 1367px 197px #FFF , 1918px 685px #FFF , 473px 950px #FFF , 756px 325px #FFF , 1865px 1843px #FFF , 1752px 251px #FFF , 438px 985px #FFF , 1280px 1553px #FFF , 798px 179px #FFF , 364px 1994px #FFF , 1342px 338px #FFF , 567px 826px #FFF , 792px 1678px #FFF , 1711px 767px #FFF , 1581px 1563px #FFF , 1095px 1793px #FFF , 516px 411px #FFF , 1074px 1044px #FFF , 1594px 1334px #FFF , 751px 1229px #FFF , 294px 849px #FFF , 907px 443px #FFF , 1370px 908px #FFF , 245px 554px #FFF , 1983px 1367px #FFF , 1084px 354px #FFF , 818px 1146px #FFF , 1368px 766px #FFF , 1128px 638px #FFF , 1917px 531px #FFF , 1060px 334px #FFF , 801px 1269px #FFF , 1510px 860px #FFF , 1094px 657px #FFF , 1829px 1125px #FFF , 105px 1640px #FFF , 244px 342px #FFF , 939px 1989px #FFF , 193px 696px #FFF , 210px 1665px #FFF , 948px 1949px #FFF , 487px 354px #FFF , 1812px 1020px #FFF , 744px 241px #FFF , 1964px 1816px #FFF , 700px 1162px #FFF , 1673px 357px #FFF , 663px 1240px #FFF , 1287px 262px #FFF , 1509px 705px #FFF , 1962px 1426px #FFF , 1034px 68px #FFF , 1743px 296px #FFF , 889px 1510px #FFF , 1387px 1668px #FFF , 1772px 988px #FFF , 267px 1818px #FFF , 227px 1727px #FFF , 301px 188px #FFF , 1292px 660px #FFF , 1296px 1409px #FFF , 129px 1161px #FFF , 1709px 1818px #FFF , 642px 669px #FFF , 1250px 317px #FFF , 1310px 243px #FFF , 1168px 1670px #FFF , 248px 5px #FFF , 112px 101px #FFF , 1788px 959px #FFF , 125px 416px #FFF , 344px 588px #FFF , 273px 1817px #FFF , 126px 1229px #FFF , 1779px 1825px #FFF , 1965px 1496px #FFF , 1723px 843px #FFF , 1347px 1192px #FFF , 1600px 369px #FFF , 111px 322px #FFF , 1742px 1998px #FFF , 783px 322px #FFF , 1568px 657px #FFF , 96px 895px #FFF , 1542px 787px #FFF , 657px 1214px #FFF , 1545px 857px #FFF , 1732px 1907px #FFF , 884px 955px #FFF , 1028px 400px #FFF , 906px 1721px #FFF , 1549px 373px #FFF , 846px 1851px #FFF , 411px 663px #FFF , 7px 929px #FFF , 1781px 1767px #FFF , 739px 1747px #FFF , 1695px 398px #FFF , 437px 1674px #FFF , 1858px 46px #FFF , 1335px 161px #FFF , 247px 1885px #FFF , 1834px 1838px #FFF , 1712px 1656px #FFF , 1024px 1318px #FFF , 422px 262px #FFF , 1795px 901px #FFF , 652px 1325px #FFF , 192px 755px #FFF , 331px 1331px #FFF , 57px 1108px #FFF , 985px 347px #FFF , 1969px 1874px #FFF , 1261px 1266px #FFF , 662px 1805px #FFF , 1428px 1850px #FFF , 859px 998px #FFF , 848px 753px #FFF , 1744px 187px #FFF , 294px 1480px #FFF , 1083px 1591px #FFF , 1750px 1971px #FFF , 1874px 1252px #FFF , 1203px 237px #FFF , 809px 1248px #FFF , 693px 1515px #FFF , 987px 984px #FFF , 624px 390px #FFF , 742px 1949px #FFF , 1664px 1401px #FFF , 1902px 1067px #FFF , 1px 48px #FFF , 1045px 459px #FFF , 217px 289px #FFF , 54px 666px #FFF , 501px 1738px #FFF , 710px 1641px #FFF , 639px 1673px #FFF , 1572px 597px #FFF , 537px 1035px #FFF , 1532px 1882px #FFF , 1567px 1948px #FFF , 814px 852px #FFF , 1601px 1439px #FFF , 812px 662px #FFF , 610px 1394px #FFF , 164px 1117px #FFF , 147px 1939px #FFF , 1711px 1236px #FFF , 801px 1100px #FFF , 41px 1995px #FFF , 1909px 1067px #FFF , 1045px 1607px #FFF , 234px 1469px #FFF , 611px 444px #FFF , 370px 1154px #FFF , 271px 58px #FFF , 865px 1164px #FFF , 1923px 1779px #FFF , 1152px 1647px #FFF , 1615px 862px #FFF , 1560px 1514px #FFF , 879px 841px #FFF , 1175px 1326px #FFF , 330px 1768px #FFF , 288px 1288px #FFF , 329px 1687px #FFF , 579px 988px #FFF , 1431px 300px #FFF , 1707px 1939px #FFF , 655px 97px #FFF , 459px 1860px #FFF , 14px 1505px #FFF , 1783px 1297px #FFF , 651px 1475px #FFF , 1397px 589px #FFF , 1038px 1777px #FFF , 653px 1028px #FFF , 1474px 1018px #FFF , 824px 1456px #FFF , 273px 1465px #FFF , 1620px 131px #FFF , 1226px 1359px #FFF , 1026px 1794px #FFF , 604px 348px #FFF , 1291px 734px #FFF , 1403px 60px #FFF , 1530px 338px #FFF , 1323px 212px #FFF , 418px 1525px #FFF , 619px 444px #FFF , 1534px 520px #FFF , 351px 802px #FFF , 1494px 1954px #FFF , 778px 424px #FFF , 962px 191px #FFF , 1600px 1056px #FFF , 966px 240px #FFF , 986px 1123px #FFF , 154px 1538px #FFF , 1273px 719px #FFF , 1089px 264px #FFF , 1763px 253px #FFF , 1557px 1493px #FFF , 918px 488px #FFF , 1293px 1867px #FFF , 1970px 1491px #FFF , 218px 494px #FFF , 32px 589px #FFF , 1158px 1993px #FFF , 875px 1573px #FFF , 1313px 913px #FFF , 418px 1126px #FFF , 826px 1284px #FFF , 486px 1623px #FFF , 310px 440px #FFF , 922px 364px #FFF , 497px 806px #FFF , 227px 1410px #FFF , 329px 861px #FFF , 1984px 2px #FFF , 1652px 1152px #FFF , 758px 150px #FFF , 515px 408px #FFF , 100px 1168px #FFF , 1672px 559px #FFF , 475px 345px #FFF , 22px 931px #FFF , 1830px 599px #FFF , 342px 749px #FFF , 1793px 1155px #FFF , 716px 1475px #FFF , 739px 1351px #FFF , 1038px 286px #FFF , 667px 1101px #FFF , 1123px 562px #FFF , 1256px 1225px #FFF , 1314px 873px #FFF , 137px 325px #FFF , 743px 1972px #FFF , 151px 1287px #FFF , 87px 567px #FFF , 1118px 147px #FFF , 1108px 1567px #FFF , 1596px 814px #FFF , 944px 585px #FFF , 568px 37px #FFF , 230px 1464px #FFF , 540px 57px #FFF , 683px 1507px #FFF , 210px 437px #FFF , 493px 363px #FFF , 895px 636px #FFF , 1752px 871px #FFF , 994px 1911px #FFF , 1901px 1567px #FFF , 21px 1291px #FFF , 724px 1863px #FFF , 1424px 439px #FFF , 998px 1861px #FFF , 189px 1231px #FFF , 1814px 1185px #FFF , 1023px 607px #FFF , 823px 160px #FFF , 1092px 1858px #FFF , 1724px 434px #FFF , 1690px 1756px #FFF , 644px 1533px #FFF , 1140px 1279px #FFF , 417px 1482px #FFF , 853px 440px #FFF , 720px 1041px #FFF , 1359px 183px #FFF , 889px 1419px #FFF , 836px 1571px #FFF , 1903px 1036px #FFF , 1989px 568px #FFF , 1792px 1866px #FFF , 1023px 1512px #FFF , 962px 1200px #FFF , 393px 185px #FFF , 1531px 1222px #FFF , 1488px 364px #FFF , 446px 1733px #FFF , 1169px 276px #FFF , 1908px 1609px #FFF , 34px 307px #FFF , 333px 645px #FFF , 385px 1878px #FFF;
}

#stars2 {
  width: 2px;
  height: 2px;
  background: transparent;
  box-shadow: 229px 927px #FFF , 1206px 791px #FFF , 535px 1914px #FFF , 98px 1522px #FFF , 786px 289px #FFF , 1198px 1533px #FFF , 838px 759px #FFF , 1291px 1820px #FFF , 1315px 1975px #FFF , 134px 721px #FFF , 549px 1235px #FFF , 389px 1014px #FFF , 961px 1792px #FFF , 550px 2px #FFF , 1660px 1231px #FFF , 324px 1738px #FFF , 1652px 1905px #FFF , 651px 51px #FFF , 1664px 722px #FFF , 1793px 900px #FFF , 1786px 1305px #FFF , 1425px 882px #FFF , 1088px 1337px #FFF , 1700px 606px #FFF , 785px 345px #FFF , 323px 410px #FFF , 300px 1975px #FFF , 1912px 1631px #FFF , 1702px 1925px #FFF , 1579px 925px #FFF , 1946px 1701px #FFF , 63px 205px #FFF , 756px 1607px #FFF , 1274px 1326px #FFF , 1816px 984px #FFF , 1999px 772px #FFF , 1982px 1645px #FFF , 1573px 277px #FFF , 184px 1461px #FFF , 523px 1315px #FFF , 1911px 67px #FFF , 368px 530px #FFF , 1981px 1639px #FFF , 1685px 565px #FFF , 1309px 1158px #FFF , 1248px 1317px #FFF , 1774px 1789px #FFF , 813px 1271px #FFF , 510px 8px #FFF , 718px 346px #FFF , 1343px 27px #FFF , 282px 144px #FFF , 1888px 1917px #FFF , 1891px 479px #FFF , 367px 293px #FFF , 1366px 1977px #FFF , 1682px 241px #FFF , 1298px 721px #FFF , 1847px 677px #FFF , 1539px 1350px #FFF , 526px 70px #FFF , 1078px 1854px #FFF , 1200px 1092px #FFF , 519px 90px #FFF , 1842px 423px #FFF , 852px 360px #FFF , 400px 1034px #FFF , 1825px 1052px #FFF , 1682px 1071px #FFF , 1973px 1632px #FFF , 620px 320px #FFF , 269px 1px #FFF , 404px 43px #FFF , 1715px 1091px #FFF , 1297px 1232px #FFF , 1774px 835px #FFF , 1888px 1939px #FFF , 825px 294px #FFF , 1190px 1891px #FFF , 1412px 1424px #FFF , 1121px 589px #FFF , 902px 126px #FFF , 623px 1394px #FFF , 243px 1588px #FFF , 1535px 1244px #FFF , 125px 927px #FFF , 1416px 1116px #FFF , 1337px 1151px #FFF , 232px 1191px #FFF , 1522px 1229px #FFF , 358px 1091px #FFF , 1305px 295px #FFF , 1206px 984px #FFF , 886px 1890px #FFF , 592px 958px #FFF , 1297px 1765px #FFF , 1902px 759px #FFF , 1388px 1784px #FFF , 1154px 484px #FFF , 1281px 1156px #FFF , 1716px 53px #FFF , 730px 1901px #FFF , 1979px 1517px #FFF , 1203px 1719px #FFF , 1384px 1437px #FFF , 1893px 894px #FFF , 1003px 261px #FFF , 1405px 832px #FFF , 1825px 1023px #FFF , 1456px 729px #FFF , 12px 495px #FFF , 1095px 483px #FFF , 1057px 656px #FFF , 1350px 684px #FFF , 290px 1815px #FFF , 1391px 836px #FFF , 1285px 1850px #FFF , 364px 513px #FFF , 792px 1733px #FFF , 551px 1379px #FFF , 993px 1294px #FFF , 1173px 1767px #FFF , 955px 956px #FFF , 1749px 986px #FFF , 1581px 584px #FFF , 1861px 1589px #FFF , 1831px 1139px #FFF , 1626px 16px #FFF , 615px 1089px #FFF , 824px 12px #FFF , 1813px 1564px #FFF , 1199px 146px #FFF , 1146px 885px #FFF , 330px 515px #FFF , 203px 742px #FFF , 1579px 1579px #FFF , 993px 617px #FFF , 111px 455px #FFF , 90px 1263px #FFF , 1936px 450px #FFF , 761px 1213px #FFF , 1066px 848px #FFF , 7px 519px #FFF , 1650px 356px #FFF , 1068px 1385px #FFF , 421px 1875px #FFF , 1968px 229px #FFF , 475px 515px #FFF , 1335px 1387px #FFF , 423px 1070px #FFF , 734px 1129px #FFF , 1157px 719px #FFF , 1288px 850px #FFF , 120px 23px #FFF , 1127px 1531px #FFF , 1514px 53px #FFF , 1501px 1139px #FFF , 618px 213px #FFF , 701px 272px #FFF , 201px 1838px #FFF , 267px 1560px #FFF , 1550px 356px #FFF , 1182px 1429px #FFF , 1411px 1316px #FFF , 1766px 620px #FFF , 1856px 1111px #FFF , 19px 199px #FFF , 59px 974px #FFF , 1463px 921px #FFF , 1462px 1199px #FFF , 562px 1465px #FFF , 637px 429px #FFF , 1200px 538px #FFF , 230px 1398px #FFF , 22px 1668px #FFF , 586px 185px #FFF , 968px 1328px #FFF , 804px 951px #FFF , 1620px 823px #FFF , 1511px 1804px #FFF , 1883px 933px #FFF , 766px 1144px #FFF , 1285px 522px #FFF , 1236px 357px #FFF , 181px 1425px #FFF , 59px 1004px #FFF , 1782px 1876px #FFF , 1600px 1444px #FFF , 1437px 547px #FFF , 167px 1829px #FFF , 1878px 1154px #FFF , 1647px 1552px #FFF , 821px 718px #FFF , 1773px 1330px #FFF , 40px 1213px #FFF , 1266px 1780px #FFF , 179px 1828px #FFF , 340px 174px #FFF , 1515px 1162px #FFF , 1173px 1881px #FFF;
  animation: animStar 100s linear infinite;
}
#stars2:after {
  content: " ";
  position: absolute;
  top: 2000px;
  width: 2px;
  height: 2px;
  background: transparent;
  box-shadow: 229px 927px #FFF , 1206px 791px #FFF , 535px 1914px #FFF , 98px 1522px #FFF , 786px 289px #FFF , 1198px 1533px #FFF , 838px 759px #FFF , 1291px 1820px #FFF , 1315px 1975px #FFF , 134px 721px #FFF , 549px 1235px #FFF , 389px 1014px #FFF , 961px 1792px #FFF , 550px 2px #FFF , 1660px 1231px #FFF , 324px 1738px #FFF , 1652px 1905px #FFF , 651px 51px #FFF , 1664px 722px #FFF , 1793px 900px #FFF , 1786px 1305px #FFF , 1425px 882px #FFF , 1088px 1337px #FFF , 1700px 606px #FFF , 785px 345px #FFF , 323px 410px #FFF , 300px 1975px #FFF , 1912px 1631px #FFF , 1702px 1925px #FFF , 1579px 925px #FFF , 1946px 1701px #FFF , 63px 205px #FFF , 756px 1607px #FFF , 1274px 1326px #FFF , 1816px 984px #FFF , 1999px 772px #FFF , 1982px 1645px #FFF , 1573px 277px #FFF , 184px 1461px #FFF , 523px 1315px #FFF , 1911px 67px #FFF , 368px 530px #FFF , 1981px 1639px #FFF , 1685px 565px #FFF , 1309px 1158px #FFF , 1248px 1317px #FFF , 1774px 1789px #FFF , 813px 1271px #FFF , 510px 8px #FFF , 718px 346px #FFF , 1343px 27px #FFF , 282px 144px #FFF , 1888px 1917px #FFF , 1891px 479px #FFF , 367px 293px #FFF , 1366px 1977px #FFF , 1682px 241px #FFF , 1298px 721px #FFF , 1847px 677px #FFF , 1539px 1350px #FFF , 526px 70px #FFF , 1078px 1854px #FFF , 1200px 1092px #FFF , 519px 90px #FFF , 1842px 423px #FFF , 852px 360px #FFF , 400px 1034px #FFF , 1825px 1052px #FFF , 1682px 1071px #FFF , 1973px 1632px #FFF , 620px 320px #FFF , 269px 1px #FFF , 404px 43px #FFF , 1715px 1091px #FFF , 1297px 1232px #FFF , 1774px 835px #FFF , 1888px 1939px #FFF , 825px 294px #FFF , 1190px 1891px #FFF , 1412px 1424px #FFF , 1121px 589px #FFF , 902px 126px #FFF , 623px 1394px #FFF , 243px 1588px #FFF , 1535px 1244px #FFF , 125px 927px #FFF , 1416px 1116px #FFF , 1337px 1151px #FFF , 232px 1191px #FFF , 1522px 1229px #FFF , 358px 1091px #FFF , 1305px 295px #FFF , 1206px 984px #FFF , 886px 1890px #FFF , 592px 958px #FFF , 1297px 1765px #FFF , 1902px 759px #FFF , 1388px 1784px #FFF , 1154px 484px #FFF , 1281px 1156px #FFF , 1716px 53px #FFF , 730px 1901px #FFF , 1979px 1517px #FFF , 1203px 1719px #FFF , 1384px 1437px #FFF , 1893px 894px #FFF , 1003px 261px #FFF , 1405px 832px #FFF , 1825px 1023px #FFF , 1456px 729px #FFF , 12px 495px #FFF , 1095px 483px #FFF , 1057px 656px #FFF , 1350px 684px #FFF , 290px 1815px #FFF , 1391px 836px #FFF , 1285px 1850px #FFF , 364px 513px #FFF , 792px 1733px #FFF , 551px 1379px #FFF , 993px 1294px #FFF , 1173px 1767px #FFF , 955px 956px #FFF , 1749px 986px #FFF , 1581px 584px #FFF , 1861px 1589px #FFF , 1831px 1139px #FFF , 1626px 16px #FFF , 615px 1089px #FFF , 824px 12px #FFF , 1813px 1564px #FFF , 1199px 146px #FFF , 1146px 885px #FFF , 330px 515px #FFF , 203px 742px #FFF , 1579px 1579px #FFF , 993px 617px #FFF , 111px 455px #FFF , 90px 1263px #FFF , 1936px 450px #FFF , 761px 1213px #FFF , 1066px 848px #FFF , 7px 519px #FFF , 1650px 356px #FFF , 1068px 1385px #FFF , 421px 1875px #FFF , 1968px 229px #FFF , 475px 515px #FFF , 1335px 1387px #FFF , 423px 1070px #FFF , 734px 1129px #FFF , 1157px 719px #FFF , 1288px 850px #FFF , 120px 23px #FFF , 1127px 1531px #FFF , 1514px 53px #FFF , 1501px 1139px #FFF , 618px 213px #FFF , 701px 272px #FFF , 201px 1838px #FFF , 267px 1560px #FFF , 1550px 356px #FFF , 1182px 1429px #FFF , 1411px 1316px #FFF , 1766px 620px #FFF , 1856px 1111px #FFF , 19px 199px #FFF , 59px 974px #FFF , 1463px 921px #FFF , 1462px 1199px #FFF , 562px 1465px #FFF , 637px 429px #FFF , 1200px 538px #FFF , 230px 1398px #FFF , 22px 1668px #FFF , 586px 185px #FFF , 968px 1328px #FFF , 804px 951px #FFF , 1620px 823px #FFF , 1511px 1804px #FFF , 1883px 933px #FFF , 766px 1144px #FFF , 1285px 522px #FFF , 1236px 357px #FFF , 181px 1425px #FFF , 59px 1004px #FFF , 1782px 1876px #FFF , 1600px 1444px #FFF , 1437px 547px #FFF , 167px 1829px #FFF , 1878px 1154px #FFF , 1647px 1552px #FFF , 821px 718px #FFF , 1773px 1330px #FFF , 40px 1213px #FFF , 1266px 1780px #FFF , 179px 1828px #FFF , 340px 174px #FFF , 1515px 1162px #FFF , 1173px 1881px #FFF;
}

#stars3 {
  width: 3px;
  height: 3px;
  background: transparent;
  box-shadow: 1349px 716px #FFF , 1554px 1677px #FFF , 1395px 1162px #FFF , 1807px 1757px #FFF , 1113px 1625px #FFF , 587px 708px #FFF , 1110px 1743px #FFF , 1432px 1553px #FFF , 1555px 1481px #FFF , 275px 104px #FFF , 306px 853px #FFF , 1794px 1711px #FFF , 1520px 1410px #FFF , 91px 916px #FFF , 1737px 780px #FFF , 1852px 1882px #FFF , 1499px 1083px #FFF , 1786px 462px #FFF , 1756px 1488px #FFF , 192px 86px #FFF , 344px 51px #FFF , 653px 791px #FFF , 1148px 1988px #FFF , 1376px 947px #FFF , 1632px 1925px #FFF , 1285px 718px #FFF , 448px 1934px #FFF , 515px 1716px #FFF , 1544px 1161px #FFF , 1188px 773px #FFF , 1517px 1540px #FFF , 65px 1339px #FFF , 201px 1589px #FFF , 772px 1845px #FFF , 1933px 332px #FFF , 1606px 1262px #FFF , 223px 1186px #FFF , 521px 140px #FFF , 983px 298px #FFF , 1861px 98px #FFF , 1893px 1977px #FFF , 1038px 471px #FFF , 1540px 1079px #FFF , 677px 993px #FFF , 598px 798px #FFF , 794px 1823px #FFF , 1412px 151px #FFF , 1774px 39px #FFF , 989px 18px #FFF , 1087px 1207px #FFF , 207px 1983px #FFF , 1338px 1329px #FFF , 824px 1388px #FFF , 336px 1341px #FFF , 481px 1807px #FFF , 1562px 1895px #FFF , 632px 1908px #FFF , 732px 1137px #FFF , 141px 1906px #FFF , 1941px 752px #FFF , 830px 1911px #FFF , 1996px 972px #FFF , 1464px 1436px #FFF , 1020px 1903px #FFF , 1249px 421px #FFF , 982px 1944px #FFF , 646px 1950px #FFF , 1880px 1050px #FFF , 908px 788px #FFF , 1860px 1748px #FFF , 368px 370px #FFF , 1691px 584px #FFF , 1692px 1460px #FFF , 1572px 116px #FFF , 1819px 1124px #FFF , 917px 859px #FFF , 823px 826px #FFF , 896px 1171px #FFF , 1924px 1902px #FFF , 339px 864px #FFF , 1154px 1586px #FFF , 156px 910px #FFF , 1487px 562px #FFF , 1279px 1201px #FFF , 1218px 1906px #FFF , 1285px 1534px #FFF , 1693px 935px #FFF , 651px 1655px #FFF , 1437px 1267px #FFF , 1199px 476px #FFF , 1798px 1877px #FFF , 1135px 1634px #FFF , 1868px 1259px #FFF , 971px 1047px #FFF , 1653px 1723px #FFF , 784px 1087px #FFF , 706px 1959px #FFF , 1070px 1349px #FFF , 298px 111px #FFF , 1697px 1106px #FFF;
  animation: animStar 150s linear infinite;
}
#stars3:after {
  content: " ";
  position: absolute;
  top: 2000px;
  width: 3px;
  height: 3px;
  background: transparent;
  box-shadow: 1349px 716px #FFF , 1554px 1677px #FFF , 1395px 1162px #FFF , 1807px 1757px #FFF , 1113px 1625px #FFF , 587px 708px #FFF , 1110px 1743px #FFF , 1432px 1553px #FFF , 1555px 1481px #FFF , 275px 104px #FFF , 306px 853px #FFF , 1794px 1711px #FFF , 1520px 1410px #FFF , 91px 916px #FFF , 1737px 780px #FFF , 1852px 1882px #FFF , 1499px 1083px #FFF , 1786px 462px #FFF , 1756px 1488px #FFF , 192px 86px #FFF , 344px 51px #FFF , 653px 791px #FFF , 1148px 1988px #FFF , 1376px 947px #FFF , 1632px 1925px #FFF , 1285px 718px #FFF , 448px 1934px #FFF , 515px 1716px #FFF , 1544px 1161px #FFF , 1188px 773px #FFF , 1517px 1540px #FFF , 65px 1339px #FFF , 201px 1589px #FFF , 772px 1845px #FFF , 1933px 332px #FFF , 1606px 1262px #FFF , 223px 1186px #FFF , 521px 140px #FFF , 983px 298px #FFF , 1861px 98px #FFF , 1893px 1977px #FFF , 1038px 471px #FFF , 1540px 1079px #FFF , 677px 993px #FFF , 598px 798px #FFF , 794px 1823px #FFF , 1412px 151px #FFF , 1774px 39px #FFF , 989px 18px #FFF , 1087px 1207px #FFF , 207px 1983px #FFF , 1338px 1329px #FFF , 824px 1388px #FFF , 336px 1341px #FFF , 481px 1807px #FFF , 1562px 1895px #FFF , 632px 1908px #FFF , 732px 1137px #FFF , 141px 1906px #FFF , 1941px 752px #FFF , 830px 1911px #FFF , 1996px 972px #FFF , 1464px 1436px #FFF , 1020px 1903px #FFF , 1249px 421px #FFF , 982px 1944px #FFF , 646px 1950px #FFF , 1880px 1050px #FFF , 908px 788px #FFF , 1860px 1748px #FFF , 368px 370px #FFF , 1691px 584px #FFF , 1692px 1460px #FFF , 1572px 116px #FFF , 1819px 1124px #FFF , 917px 859px #FFF , 823px 826px #FFF , 896px 1171px #FFF , 1924px 1902px #FFF , 339px 864px #FFF , 1154px 1586px #FFF , 156px 910px #FFF , 1487px 562px #FFF , 1279px 1201px #FFF , 1218px 1906px #FFF , 1285px 1534px #FFF , 1693px 935px #FFF , 651px 1655px #FFF , 1437px 1267px #FFF , 1199px 476px #FFF , 1798px 1877px #FFF , 1135px 1634px #FFF , 1868px 1259px #FFF , 971px 1047px #FFF , 1653px 1723px #FFF , 784px 1087px #FFF , 706px 1959px #FFF , 1070px 1349px #FFF , 298px 111px #FFF , 1697px 1106px #FFF;
}

@keyframes animStar {
  from {
    transform: translateY(-2000px);
  }
  to {
    transform: translateY(0px);
  }
}

::placeholder {
    color: #9d9d9d;
    opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
   color: #9d9d9d;
}

::-ms-input-placeholder { /* Microsoft Edge */
   color: #9d9d9d;
}
input{
	color:#9d9d9d;
}

</style>
</head>


<body>
<?php 
	use xPaw\MinecraftQuery;
	use xPaw\MinecraftQueryException;

	// Edit this ->
	define( 'MQ_SERVER_ADDR', '192.99.44.79' );
	define( 'MQ_SERVER_PORT', 25565 );
	define( 'MQ_TIMEOUT', 1 );
	// Edit this <-

	// Display everything in browser, because some people can't look in logs for errors
	Error_Reporting( E_ALL | E_STRICT );
	Ini_Set( 'display_errors', true );
	
	require __DIR__ . '/MinecraftQueryException.php';
	require __DIR__ . '/MinecraftQuery.php';
	
	$Timer = MicroTime( true );
	
	$Query = new MinecraftQuery( );
	
	try {
		$Query->Connect( MQ_SERVER_ADDR, MQ_SERVER_PORT, MQ_TIMEOUT );
	}
	catch( MinecraftQueryException $e ) {
		$Exception = $e;
	}
	$Timer = Number_Format( MicroTime( true ) - $Timer, 4, '.', '' );
?>
<!-- login-form-dropdown -->
<div class="login-form-wrap">
	<div class="login-form-container">
		<div id="login-form-dropdown" class="login-form-dropdown">
			<form method="POST" action="login.php" id="login-form">
				<!-- Username:  --><input type="text" name="username" id="username" placeholder="Username" required/>
				<!-- Password:  --><input type="password" name="pass" id="pass" placeholder="Password" required/>
				<button type="submit">Submit</button>		
				<!-- <input type="submit" name="submitbtn" id="submitbtn"> -->
			</form>
		</div>
	</div>
</div>
<!-- /login-form-dropdown -->

<div id="container">
	<header id="header">
		<div id="dlc">
			<h1>DLCIncluded</h1>
		</div>
		<!-- dlc -->
		<button id="login-button" class="login-button"> Login </button>
	<!-- login-button -->
	<!-- <span id="clear"></span> -->
	</header><!-- header -->
<span id="clear"></span>

	<aside id="sidebar-left">
	
		<ul>
			<li><a href="#">News</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Apply</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Home</a></li>
		</ul>
	
	</aside><!-- sidebar-left -->
	<content id="main-content">
	
		<h1>Main Header</h1>
		<p>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sodales consectetur neque, vitae ultrices mi faucibus a. Donec imperdiet vitae eros nec eleifend. Praesent vitae neque diam. Donec id dolor nec nunc imperdiet consectetur. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut non gravida ante, finibus dapibus ipsum. Ut facilisis sodales metus. Donec nulla velit, viverra id sapien quis, rutrum fermentum nisl. Integer risus nulla, hendrerit a interdum non, dictum vel risus. Sed volutpat est quis lobortis posuere. Proin cursus mi et placerat vehicula. Vestibulum vel cursus ipsum, volutpat bibendum mi. Aliquam erat volutpat. Donec ac dignissim urna.

			Donec fermentum arcu at porta bibendum. Donec cursus quis ligula ut pulvinar. Curabitur scelerisque blandit arcu, vel pharetra elit viverra a. Donec id leo at justo rhoncus convallis. Nullam scelerisque arcu urna, eget tincidunt eros lacinia nec. Nullam non magna et tellus placerat pharetra id elementum justo. Cras euismod massa odio, et feugiat nisl tristique quis. Integer dictum erat ipsum, vitae ultricies magna gravida at. Pellentesque sit amet justo massa. Duis gravida scelerisque euismod. Proin et congue tellus. Phasellus a mattis ipsum. Integer vel massa non velit ultrices fermentum. Donec eget augue felis. Nullam non molestie nulla, ac iaculis magna. Etiam non enim in nisi tincidunt eleifend at ac lectus.

			Sed sit amet mauris in dui mollis euismod. Pellentesque dui purus, consequat sed ligula sit amet, sodales porttitor diam. Proin nec tortor interdum, lobortis nibh in, aliquet massa. In quis nibh rutrum mauris malesuada ultricies. Duis ut massa viverra, vehicula velit quis, ullamcorper arcu. Nulla sit amet ultrices leo. Duis vitae hendrerit mauris. Cras lobortis magna eu elit convallis sollicitudin. Nullam metus ligula, mattis et velit maximus, laoreet interdum libero. Sed egestas metus mauris, eu congue magna convallis eu. Sed sed justo vitae quam fermentum suscipit sed sed orci. Fusce elementum ac magna at faucibus.
		</p>
	
	</content><!-- main-content -->
	<aside id="sidebar-right">
	Connected players:
	<ul>
<?php if( ( $Players = $Query->GetPlayers( ) ) !== false ): ?>
<?php foreach( $Players as $Player ): 

	$sql = "SELECT * FROM Users WHERE mcUsername='".$Player."'";


	$result = $connection->query($sql); 
	
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$username=$row['username'];
		}
	?>
	<li><a href="profile.php?username=<?PHP echo $username ?>"><?php echo htmlspecialchars( $Player ); ?></a></li>
	<?php
	}else{

?>
	<li><?php echo htmlspecialchars( $Player ); ?></li>
<?php 
	}
endforeach; ?>
</ul>
<?php else: ?>
						<div class="no-players">
							<p>No players online</p>
						</div>
<?php endif; ?>	
	</aside><!-- / sidebar-right -->
	<!-- <div id="sidebar-right2">
	
	Outer Side Bar
	
	Something can go here... <br>
	Maybe profile info or <br>
	something...
	
	</div><!-- sidebar-right2 -->
</div><!-- / container -->

<!-- Partical effect  -->
<div class="stars-container">
	<div id="stars"></div>
	<div id="stars2"></div>
	<div id="stars3"></div>
</div>
<!-- / partical effect -->


</body>
</html>