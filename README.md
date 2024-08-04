# Coding exercise

Solution of [Kata09: Back to the Checkout](http://codekata.com/kata/kata09-back-to-the-checkout/)

## Note

Discount algorithm has been slightly modified.
The original task's notion of quantity discount is unusual: with discount for 3rd item, 
the price of 4th item is considered equal to the basic/unit price. Consequently,
when the algorithm uses more usual notion of quantity discount (discounted price is used, whenever quantity
reaches or exceeds the quantity threshold of the discounted price), the line 17 of the 
test in task fails.

I realized this only during finalization of the [CheckOut class](src/Logic/CheckOut/CheckOut.php), and decided not 
to change the logic to the original concept. As a result, the test was also modified.


