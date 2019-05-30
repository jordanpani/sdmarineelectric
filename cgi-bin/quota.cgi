#!/usr/bin/perl

##########################################################################
# Created 3/11/04 by iBizVision						 #
# This program was created for the iBizPanel by the iBizVision Software  #
#  team and is not to be duplicated, resold or reused without the	 #
#  written consent of iBizVision.					 #
#									 #
# quota.cgi is a simple program to display the current disk usage of	 #
#  a particular domain hosted within the iBizPanel.			 #
##########################################################################

use strict;
use Quota;

my $group_name = $ENV{"SERVER_NAME"};
my @grent = getgrnam($group_name);

my $dev = Quota::getqcarg("/home");

my ($block_curr, $block_soft, $block_hard, $block_timelimit, $inode_curr, $inode_soft, $inode_hard, $inode_timelimit) = Quota::query($dev, $grent[2], 1);

my $sitename = $group_name;
my $used = 0;
$used = $block_curr / 1000 if ($block_curr > 0);
$used = sprintf("%.2f",$used);
my $total = 0;
$total = $block_hard / 1000 if ($block_hard > 0);
my $free = $total - $used;
my $percent = 0;
$percent = ($used / $total) * 100 if ($used > 0 && $total > 0);
$percent = sprintf("%.2f",$percent);

my $bar;
$bar = "<table style=\"border-style: solid; border-color: black;\"><tr><td>";
$bar .= "\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n  <tr>\n";

my $color = "green";
$color = "red" if ($percent > 85);
for (1..100)
{
        $bar .= "    <td bgcolor=\"$color\">&nbsp;</td>\n";
        $color = "white" if ($_ > $percent);
}

$bar .= "  </tr>\n</table>\n";
$bar .= "</td></tr></table>";

print "Content-Type: text/html; charset=UTF-8\n\n";
print <<EOF;
<html>
<head>
<title>Site Usage</title>
</head>
<body bgcolor="white">
<div align="center">
<center>
<br><br><br>
<table border="0" width="500" height="90%">
  <tr>
    <td valign="top" width="100%" height="95%" align="center">
    <font size="4" color="blue"><b>Disk Space Usage</b></font>
    <br><font size="3">for <b>$sitename</b></font>
    <br><br>
      <table border="0" align="center">
        <tr>
          <td>
                You are currently using <b>$used MB</b> and have <b>$free MB</b> free.
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>$bar</td>
        </tr>
        <tr>
          <td>$percent\% of $total MB used.</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width="100%" height="5%" align="center">
        <font size="2"></font>
    </td>
  </tr>
</table>
</div>
</body>
</html>
EOF
exit;
