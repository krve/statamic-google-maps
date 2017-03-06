### Installation

Clone or download the repository and move the "GoogleMaps" folder into your `site/addons` folder.


### Setup

Add your Google Maps JS API Key to the settings page `../cp/addons/google-maps/settings`


### Usage

You can now use google maps like so:

```
{{ google_maps address="1600 Amphitheatre Parkway" height="400px" }}
```

### Options

The following options are available

- address
- height
- width
- zoom (The level of zoom)
- markers

#### Adding your own markers
You can add your own markers to the map using the following syntax
```
{{ google_maps address="1600 Amphitheatre Parkway" height="400px" markers="Example Address 1;Example Address 2" }}
```
The `;` represents a split. Use this if you have multiple markers.


### Contribution

Feel free to submit pull requests if you have any ideas on how to improve the addon.

