# ramverk1

Install with composer `composer require sandrakh/weather-module`

# Require in composer.json

Add require to you compose.json-file like this:

`    "require": {
        "sandrakh/weather-module": "^1.1"
    }`
    
# Add files from module to right folders 

`
rsync -av vendor/sandrakh/weather-module/src ./
rsync -av vendor/sandrakh/weather-module/test ./
rsync -av vendor/sandrakh/weather-module/config ./
rsync -av vendor/sandrakh/weather-module/view ./
`
