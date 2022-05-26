#!/usr/bin/perl

my ($z) = $ENV{'QUERY_STRING'} =~ /z=(.*)/;
$z = URI_unescape($z);
$z =~ tr/0-9//cd;
print "Content-Type: text/html\n\n";
open( FH, "d:/usr/arouge/sdocs/sample/js/zipcode/postal.tsv" );
while (<FH>) {
    next if ( $_ !~ /^$z/ );
    print $_ . "\t";
    exit;
}
close(FH);

sub URI_unescape {
    my $str = shift;
    $str =~ s/%([0-9A-Fa-f][0-9A-Fa-f])/pack('H2', $1)/eg;
    $str;
}

