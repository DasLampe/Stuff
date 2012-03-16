#! /bin/bash

if [ ! $1 ]; then
   echo "Syntax: $0 [playlist filename]"
   exit 0
fi

tmpdir="/tmp/playlist2cd."$RANDOM

cat $1 | grep -v '#' | tr -d '\r' | \
while read x;
	do
		mkdir -p $tmpdir;
		cp "${x}" $tmpdir;
		cd $tmpdir;
		newFileName=`echo $(basename "${x}") | tr ' ' '_'`;
		echo `basename "${x}"` | egrep -q "[[:space:]]" && mv "`basename "${x}"`" $newFileName;
		lame --decode "$newFileName" "`basename "$newFileName" .[mpMP]3`.wav";
	done
wodim -d -v -pad -audio dev=/dev/sr0 -dao -swab $tmpdir/*.wav
rm -rf $tmpdir
