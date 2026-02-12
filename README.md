# HyperBoost

HyperBoost is an advanced performance optimization engine for Laravel designed to:

* Reduce latency
* Increase throughput
* Optimize compile-time
* Eliminate runtime overhead
* Be ready for Shared Hosting, VPS, and Dedicated Server environments

All optimizations are executed during the compile and warmup stages — ensuring zero additional load on the user’s first request.

---

# Installation

## Install via Composer

```bash
composer require fhylabs/hyperboost
```

## Install Locally (Path Repository)

Add this to your application's `composer.json`:

```json
"repositories": [
    {
        "type": "path",
        "url": "HyperBoost"
    }
]
```

Then run:

```bash
composer require fhylabs/hyperboost:@dev
```

---

## Install & Compile

```bash
php artisan hyper:install
```

This command will:

* Publish configuration
* Compile cache
* Warm up routes and queries
* Generate integrity hash

---

# Configuration

After installation, configuration is available at:

```
config/hyperboost.php
```

Example configuration:

```php
return [

    'enabled' => env('HYPERBOOST_ENABLED', true),

    'environment' => 'auto',

    'warmup_routes' => [
        '/',
        '/login',
    ],

    'cache_path' => 'bootstrap/cache',

    'integrity_hash' => true,
];
```

---

# Available Commands

## Compile Optimization

```bash
php artisan hyper:compile
```

Performs:

* config:cache
* route:cache
* view:cache
* event:cache
* Container compilation
* Preload generation
* Integrity hash generation
* Composer optimized autoload

---

## Warmup Cache

```bash
php artisan hyper:warmup
```

Performs:

* Pre-hits popular routes
* Warms up database metadata
* Primes application cache

---

## Analyze Database

```bash
php artisan hyper:analyze
```

Displays:

* Table list
* Number of indexes per table

---

## Benchmark

```bash
php artisan hyper:benchmark
```

Runs a lightweight benchmark to measure internal performance improvements.

---

## Install (All-in-One)

```bash
php artisan hyper:install
```

Runs compile and warmup in a single command.

---

# Environment Mode

HyperBoost automatically detects the environment:

| Environment    | Behavior                       |
| -------------- | ------------------------------ |
| Shared Hosting | File-based static optimization |
| VPS            | Redis-aware optimization       |
| Dedicated      | Preload-ready optimization     |

Detection is based on:

* Redis extension availability
* OPcache preload support
* Shell access

Manual override:

```php
'environment' => 'shared' // shared / vps / dedicated
```

---

# Deployment (Production Best Practice)

Add this to your deployment pipeline:

```bash
php artisan down
php artisan hyper:compile
php artisan hyper:warmup
php artisan up
```

Without maintenance mode:

```bash
php artisan hyper:compile
php artisan hyper:warmup
```

---

# Recommended Production Setup

## Shared Hosting

* Use file-based cache
* Avoid closure routes
* Use controller-based routes

## VPS

Add to `php.ini`:

```
opcache.memory_consumption=256
opcache.max_accelerated_files=20000
opcache.validate_timestamps=0
```

Use Redis as cache driver:

```
CACHE_DRIVER=redis
```

## Dedicated Server

Enable preload:

```
opcache.preload=/path/to/bootstrap/cache/hyper_preload.php
```

Recommended:

* Redis
* Separate database server
* Nginx microcache (optional)

---

# Integrity Protection

HyperBoost stores a hash of `composer.lock`.

If dependencies change, re-run:

```bash
php artisan hyper:compile
```

---

# Generated Cache Files

All generated files are stored in:

```
bootstrap/cache/
```

Examples:

* hyper_config.php
* hyper_routes.php
* hyper_container.php
* hyper_preload.php
* hyper_static.php
* hyper_integrity.hash

---

# Safety

HyperBoost:

* Does not override Laravel core
* Does not replace the kernel
* Does not modify the request lifecycle
* Can be safely removed without breaking the application

---

# Disable HyperBoost

In `.env`:

```
HYPERBOOST_ENABLED=false
```

Or remove the package:

```bash
composer remove fhylabs/hyperboost
```

---

# Expected Performance Gain

| Scenario             | Improvement     |
| -------------------- | --------------- |
| Vanilla Laravel      | 40–90%          |
| Already cached setup | 5–30%           |
| High-traffic VPS     | 2–3x throughput |
| Dedicated + tuning   | 2–5x RPS        |

Results depend on architecture and workload.

---

# Recommended Workflow

During development:

* No need to run compile on every change

During staging or production:

* Run `hyper:compile` on every deploy
* Run `hyper:warmup` after deploy

---

# Troubleshooting

## Cache Not Updating

```bash
php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan hyper:compile
```

## Preload Not Working

Ensure in `php.ini`:

```
opcache.enable=1
opcache.enable_cli=1
```
