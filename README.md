# PHPGen

### Installation

```bash
composer require hkwak/phpgen
```

### Usage example

```php

// 1. Creating some properties

$nameProperty = (new PropertyModel('name', 'string', AccessEnum::PROTECTED()))
    ->setDescription('The name of something')
    ->setDefaultValue('Default name');

$dobProperty = new PropertyModel('dob', 'string', AccessEnum::PROTECTED());
    
// 2. Creating the public setName method

// initializing the method body
$methodBody = '$this->name = $name;';

$setNameMethod =(new MethodModel('setName'))
    ->setAccess(AccessEnum::PUBLIC())
    ->setDescription('This is a method description')
    ->setReturn('self')
    ->addParameter(new ParameterModel('name', 'string'))    
    ->addThrows(InvalidArgumentException::class)    
    ->setBody($methodBody);

$classModel = (new ClassModel('TestClass'))
    ->addTrait(SomeTrait::class)
    ->addProperty($nameProperty)
    ->addProperty($dobProperty)
    ->addMethod($setNameMethod)
    ->addAnnotation('some Class Annotation')
    ->setDescription('This is a description of the class')
    ->setNamespace('\\Some\Namespace\\')
    ->addUse('\\Some\\Namespace\\Class')
    ->addUse('\\Some\\Namespace\\Class2')
    ->setExtends('\\Some\\Namespace\\BaseClass');

// generating the code
$classGenerator = new ClassGenerator(
            new MethodGenerator(),
            new PropertyGenerator(),
            new NamespaceManager()
        );
        
$classCode = $classGenerator->generate($classModel);
```