# super-duper-couscous
a php+mysql rewrite of Konquest

# About Konquest:

Konquest is an awesome game, if a bit simple:
You have a number of planets, and want to take over the rest of the known universe.
It is turn-based, and in your turn you select pairs of planets (source and destination) and input a number of spaceships. 

There is apparently only one sort of ship, although each planet has a diferent level of effectiveness, represented as a number between 0 and 1.
I assume that this is (in-universe) not because of technology, but because of training of crew and stratergy, and other such things.

Each turn, each planet generates a certain per-planet number of ships, which can be used in subsequent turns, or stored on-planet. I haven't yet found if there is an upper limit to this storage, but there might be.

# About this rewrite:

I have decided to not have turns, instead have one turn equivelant to about half a minute.
