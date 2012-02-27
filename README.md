# WordPress Editables
Editables are small editable areas that make up the areas of your layout.

![Menu](https://img.skitch.com/20120227-fk1g4f5fqmqmtnsgwu6fxis2b3.png)

## Usage
After having created your editable you can access it via the following functions:

    // Prints the main content of an editable
    the_editable_content( $slug );

    // Prints a specific instance variable of the object
    the_editable_field( $slug, $field );

	// Returns the editable as an object
    get_editable( $slug );

    // Returns a specific instance variable of the object
    get_editable_field( $slug, $field );

## Todo
* Optional "edit link" to be displayed alongside editable content
* Add support for categorised editables
