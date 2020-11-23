
#!/usr/bin/env bash
#
# sandrakh/weather-module
#
# Integrate the Weather-module onto an existing anax installation.

# Copy configuration and Service setup
rsync -av vendor/sandrakh/weather-module/config ./

# Copy view files
rsync -av vendor/sandrakh/weather-module/view ./

# Copy src files
rsync -av vendor/sandrakh/weather-module/src ./

# Copy test files
rsync -av vendor/sandrakh/weather-module/test ./
