# statamic-csv plugin



## Overview

This Statamic plugin is super simple. It reads simple csv files in row column format. You specify in the tag set whether it has a header row or not.


## Installation

As in many things Statamic, you will need to be comfortable moving these files into their proper place.

1. Place the entire csv folder containing the plug-in and fieldtype .php files into the _add-ons folder



### Using the tags within the template

Now that a gallery page has been created, the plugin is used to loop through and list all the available images for the previously selected photoset.

The tag structure to plop all the data into a table from a csv file with a header row would look like this:

```
    {{csv:read file="example/header.csv" header="yes"}}	
		<tr>
		{{header}}
		<th>{{name}}</th>
		{{/header}}
		</tr>		
		{{rows}}
		<tr>
			{{columns}}
			<td>{{value}}</td>
			{{/columns}}
		</tr>		 
		{{/rows}}	
	{{/csv:read}}
```

The tag structure for a file without a header row would look like this:

```
    {{csv:read file="example/header.csv" header="no"}}	
		</tr>		
		{{rows}}
		<tr>
			{{columns}}
			<td>{{value}}</td>
			{{/columns}}
		</tr>		 
		{{/rows}}	
	{{/csv:read}}
```
