###### DEBUG
```bash
XDEBUG_TRIGGER=1 PHP_IDE_CONFIG="serverName=PHP_STORM_DEBUG" bin/console app:create-properties
```

###### DEBUG Profile
```bash
XDEBUG_MODE=profile XDEBUG_TRIGGER=1 PHP_IDE_CONFIG="serverName=PHP_STORM_DEBUG" bin/console app:create-properties
```