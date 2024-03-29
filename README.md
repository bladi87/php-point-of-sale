# PHP Skill Assessment Challenge
## point-of-sale scanning API

### Write the following feature in PHP OOP approach:

Consider a store where items have prices per unit but also volume prices.
For example, apples may be $1.00 each or 4 for $3.00.
Implement a point-of-sale scanning API that accepts an arbitrary ordering of products (similar to what would happen at a checkout line) and then returns the correct total price for an entire shopping cart based on the per-unit prices or the volume prices as applicable.

Here are the products listed by code and the prices to use (there is no sales tax):

```
Product Code | Price
--------------------------------------------------
A | $2.00 each or 4 for $7.00
B | $12.00
C | $1.25 or $6 for a six-pack
D | $0.15
```

There should be a top level point of sale terminal Service Object that looks something like the pseudocode below:

```
Terminal->setPricing(...)
Terminal->scan("A")
Terminal->scan("C")
Result = Terminal->getTotal()
```

You are free to design and implement the rest of the code however you wish, including how you specify the prices in the system.

Here are the minimal inputs you should use for your test cases. These test cases must be shown to work in your program:
1. Scan these items in this order: ABCDABAA;
   Verify the total price is $32.40.
2. Scan these items in this order: CCCCCCC;
   Verify the total price is $7.25.
3. Scan these items in this order: ABCD;
   Verify the total price is $15.40.

## How to run this project:
### With Docker

```cd docker```

```docker-compose up```

Open http://localhost:8001

### Your own apache or nginx server