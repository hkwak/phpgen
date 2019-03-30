<?php


namespace HKwak\PhpGen\Generators;


use HKwak\PhpGen\CodeStreams\PhpCodeStream;
use HKwak\PhpGen\Models\AbstractFileModel;
use HKwak\PhpGen\Models\DocBlockModel;

abstract class AbstractFileGenerator extends AbstractGenerator
{
    /**
     * @var PhpCodeStream
     */
    protected $stream;

    /**
     * @var MethodGenerator
     */
    private $methodGenerator;

    /**
     * @var NamespaceManager
     */
    private $namespaceManager;

    /**
     * PropertyGenerator constructor.
     *
     * @param MethodGenerator $methodGenerator
     * @param NamespaceManager $namespaceManager
     */
    public function __construct(MethodGenerator $methodGenerator, NamespaceManager $namespaceManager)
    {
        $this->methodGenerator = $methodGenerator;
        $this->namespaceManager = $namespaceManager;
    }

    /**
     * @param AbstractFileModel $model
     *
     * @param PhpCodeStream $stream
     *
     * @return string
     */
    public function generate(AbstractFileModel $model, PhpCodeStream $stream): string
    {
        $this->stream = $stream;
        // the heading
        $this->buildFileHeading($model);

        $this->stream
            ->code('{')
            ->indent(1);

        // the body
        $this->buildBody($model);

        // the footer
        $this->stream
            ->indent(0)
            ->code('}');


        return $this->stream->build();
    }

    /**
     * @param AbstractFileModel $model
     */
    protected function buildBody($model)
    {
        foreach ($model->getMethods() as $index => $method) {
            if ($index > 0) {
                $this->stream->eol();
            }
            $this->methodGenerator->generate($method, $this->stream);
        }
    }

    /**
     * @param AbstractFileModel $model
     *
     * @return string
     */
    abstract function buildSignature($model): string;

    /**
     * Building the docblock for a File (class, trait or interface level)
     *
     * @param AbstractFileModel $model
     *
     * @return DocBlockModel
     */
    protected function buildDocBlock(AbstractFileModel $model): DocBlockModel
    {
        $docBlock = new DocBlockModel('class '.$model->getName().($model->getDescription()?PHP_EOL.$model->getDescription():''));

        foreach ($model->getAnnotations() as $annotation) {
            $docBlock->addAnnotation($annotation['annotation'], $annotation['text']);
        }

        return $docBlock;
    }

    /**
     * Building the File heading (defining the namespace, usages, docblock and the signature)
     *
     * @param AbstractFileModel $model
     */
    protected function buildFileHeading(AbstractFileModel $model)
    {
        $this->stream->initFile();

        $this->stream->eol();

        // namespace
        if ($model->getNamespace()) {
            $this->stream->code('namespace '.$model->getNamespace().';')->eol();
        }

        // uses
        foreach ($model->getUses() as $use) {
            $namespace = $this->namespaceManager->getNamespace($use);
            if ($namespace != $model->getNamespace()) {
                $this->stream->code('use '.$use.';');
            }
        }
        if ($model->getUses()->count()) {
            $this->stream->eol(); // Only output a blank line if we outputted any "use" statements.
        }
        $this->stream->docBlockComment($this->buildDocBlock($model));
        $this->stream->code($this->buildSignature($model));
    }
}
