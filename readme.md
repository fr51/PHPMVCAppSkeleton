# PHPMVCAppSkeleton

This is a simple PHP MVC framework (inspired by Symfony). I chose to write my own one because I find Symfony oversized/overpowered and Doctrine didn't give the results I wanted

## table of contents

- [installation](#installation)
- [configuration](#configuration)
- [configurator](#configurator)
- [note regarding AJAX](#note-regarding-ajax)
- [documentation](#documentation)
- [tests](#tests)
- [changelog](#changelog)
- [next steps](#next-steps)
- [URL rewriting](#url-rewriting)
- [form builder](#form-builder)
- [dependencies](#dependencies)
- [credits](#credits)

## installation

1. Clone or download the project
2. Put it in the appropriate web server folder (in my case, Apache's "`htdocs`")

## configuration

The configuration consists in JSON files located in the "`/cfg`" folder. It already contains database info & routes; don't forget to customize these 2 files

Extra configuration can be added in additional JSON files (I recommend 1 per settings type). Any non-JSON file will result in an error

### configurator

This class reads the configuration files, then makes the content available through a public array used as a dictionary

There's no need to modify this as you add configuration files

## note regarding AJAX

> [!NOTE]
> This framework uses AJAX calls for every user action, e.g. form submission or showing pages and data

You'll probably need to get some entities ("data classes" (as it's called in Kotlin) living in the "`/model`" folder) back as JSON. In that case, make them serializable by implementing the `JsonSerializable` interface:

1. declare the class implements the `JsonSerializable` interface
2. add this method:
	```
	public function jsonSerialize (): object
	{
		return ((object) get_object_vars ($this));
	}
	```

## documentation

The code documentation is written in Doxygen format. I chose this one as it is widely used

I encourage you to extend this by documenting your controllers and views

## tests

Unit tests will be performed with PHPUnit against controllers and model. Functional ones will be performed with Robot Framework against views

## changelog

This is the initial version (1.0.0). The changelog is currently empty

### next steps

#### URL rewriting

> [!NOTE]
> The how-to will apply to Apache. Other web servers may do this differently

In a URL readability and security purpose, I will remove useless URL parts such as "`index.php?route=`"

#### form builder

In order to save time and work, this will recursively convert an entity into an equivalent HTML form. It can't be too generic, so it will use a configuration, mainly including excluded and optional fields

## dependencies

I use the following components to write this framework:

1. PHP 8.1.9
2. jQuery 3.7.0
3. SweetAlert2 11.10.3
4. Apache 2.4
5. Xdebug 3.1.5
6. PHPUnit 10.5

## credits

I asked ChatGPT to write a sample MVC structure & route system (router only). Then I customized the result