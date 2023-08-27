# Tooltip-nestle
This is a small explanation about what I did in the backend test.

*I used PHP V.7.4.33*
*Jquery 3.0 offered by Drupal*
*Drupal 9.0.0*

## What is the order of the folders:
* Add the *modules/glossary* folder to your modules path.
* Add the *themes/glossary* folder to your themes path.

After that you can move on to the next step.

---
## Install the module Glossary Tooltip:
![extend](https://github.com/anthonylilo/tooltip-nestle/assets/76402507/cd153a85-f1e9-4d28-8926-78fec52da9a6)

You have to look in the *Extend* navigation bar, which is the page where you can install the *Glossary Tooltip* module. Click on install and wait for the *success* message.

## Install the theme Glossary Tooltip:
![image](https://github.com/anthonylilo/tooltip-nestle/assets/76402507/13e9a058-4665-4463-ba58-8f07b382fa93)

You have to look in the *Appearance* navigation bar, which is the page where you can install the theme.

When you are in the page, you have to search for "Uninstalled themes" and install *Glossary 1.0.0* and set as default

![image](https://github.com/anthonylilo/tooltip-nestle/assets/76402507/679cb1e0-fd4e-4c34-82a1-c9f8ebbdb192)

This is just to load the custom styles and the js file where I created the functionality to read the HTML document and add the tooltip to the matching word.

## Glossary Tooltip module

The module have 4 routes:

1. /add-glossary
2. /glossary-list
3. /get-glossary
4. /glossary-term/{id}

Note: *get-glossary* return a json answer for the js file.

To see if everything works  let's create our first term! Go to "/add-glossary" and create a term. This is what the page looks like.
![form-glossary](https://github.com/anthonylilo/tooltip-nestle/assets/76402507/64a6a7c4-cb9d-4e41-a3d3-5a9d64613711)

Fill in the form with the title and its description. When you see the *success* message we will see the term creating in "/glossary-list"
![image](https://github.com/anthonylilo/tooltip-nestle/assets/76402507/b79bbf91-f472-4573-9add-e0109a11f8db)

In my case I created the definition of "Dramaturgo".

## Create a post
Now click on *Content* in the navigation bar to create the post, when the page reloads the content you have to see this button and you have to click on "+ Add Content"

![image](https://github.com/anthonylilo/tooltip-nestle/assets/76402507/1e5517e1-4f2f-4991-9785-73f2a4809efc)

I created Julio Verne post, let's see it!
![image](https://github.com/anthonylilo/tooltip-nestle/assets/76402507/c223dfd8-ec08-4915-9ef6-762b49716ea1)

And as you can see, the word *dramaturgo* is highlighted if you put your mouse over the word, a tooltip will appear.
![image](https://github.com/anthonylilo/tooltip-nestle/assets/76402507/87d47374-e3ff-4337-8c08-de7d147e4269)

When the description is longer than 100 characters, you can click on them and go the description term page.
![image](https://github.com/anthonylilo/tooltip-nestle/assets/76402507/ecaffb5c-2175-4c31-964f-f79ac0947cd5)

When is has lees than 100 characters, you can l in the same way you can click on the highlighted word and go the description term page.
