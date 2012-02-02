


# International Resources site #


## Updating the site description on the home page ##

The text in the "About this site" text block on the home page, just
below the main navigation bar, is not stored in a post or page. It's
stored in a text widget, accessible by going in the Dashboard to
Appearance > Widgets. The widget is stored in the widget block called
Home Top.

You could, in theory, put any widget inside that Home Top widget
block, but I strongly recommend you leave it a text widget.

*Developers*: The widget is created in functions.php and called in
only home.php.



## Adding new resources to the site ##

When you have a new resource for the site (one that gets a Resource
Type and Location taxonomy), do this to add it:

1. Create a new Post from the Dashboard by going to Posts > Add New.

2. Enter the name of the resource in the post title field. This could
be the name of the organization, the title of the blog post or
article, the name of the conference, etc.

    -   The title field is the only required field for an entry.

3. Enter the description of the resource in the post body field.

4. Enter additional information about the resource in the remaining
fields below the post body fields.

    -   These fields, as well as the description field, are optional.
        Don't worry about entering anything into fields if you don't
        have information for them or if they're inapplicable to the
        resource you're entering. Any fields left blank won't be shown
        to people who visit the site.

5. Along the right side of the page, look for the list of Categories
and check "Resources." This is only so the resource isn't filed under
"Uncategorized."

6. Below the list of Categories, look for the list of Resource Types
and check the applicable box.

7. Below the list of Resource Types is the list of Locations. Again,
check the applicable box or boxes.
    
    Deciding which Locations to add to a resource is a little tricky.
    It's worth taking a minute to see how they work.

    Almost all Locations on the site are divided into hierarchies of
    continents, regions, and countries. So we might have a hierarchy
    of Locations of "Europe", "Scandinavia", and "Sweden".
    
    In website-speak, these sorts of hierarchies are labeled like you
    would label family members. They have parents, siblings, and
    children.

    So "Europe" would be the parent of (or has the children)
    "Scandinavia" and "Sweden". "Scandinavia" would be the child of
    "Europe" and the parent of "Sweden". "Sweden" would be the child
    of both "Europe" and "Scandinavia" but would not have children (it
    might have a sibling of, say, "Finland"). 

    When assigning Locations to a resource, *don't automatically also
    select the parents of your choices*. If you add "Sweden", you
    shouldn't necessarily also add "Scandanavia" or "Europe". The
    reason is that each Location has its own page on the website where
    visitors can see all the resources labeled with that Location, and
    a resource of interest to someone looking at the Sweden page might
    not also interest someone looking at the Europe page.

    If a blogger in Sweden writes a post in Swedish about religion in
    Swedish newspapers, there's probably no need to add any Location
    other than Sweden. But if the blogger writes a post about religion
    in European newspapers, you might add all three.

    You needn't agonize over your decision. You just need to think for
    a minute like someone browsing the page for Location X and asking
    whether you would want to know about that particular resource
    while on that page.

8. At the top-right of the page, click Save Draft, then Preview. If
all looks well, click Publish.
