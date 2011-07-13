#! /bin/bash
x=973
y=301
z=1

while [ $z != 0 ]; do
	echo "ggt($x,$y)"
	let z=($x % $y)
	x=$y
	y=$z
done
echo "$x"
exit 0	
