<?php


namespace HKwak\PhpGen\CodeStreams;


use HKwak\PhpGen\Models\DocBlockModel;
use HKwak\PhpGen\Types\StringCollection;

class PhpCodeStream
{
    const DEFAULT_TAB_SIZE = 4;

    /**
     * @var StringCollection
     */
    protected $code;

    /**
     * @var int
     */
    protected $currentIndent = 0;

    /**
     * @var int
     */
    protected $tabSize = self::DEFAULT_TAB_SIZE;

    /**
     * PhpCodeStream constructor.
     *
     * @param int|null $tabSize The tab size ( default is 4 spaces )
     */
    public function __construct(int $tabSize = null)
    {
        if ($tabSize) {
            $this->tabSize = $tabSize;
        }
        $this->code = new StringCollection();
    }

    /**
     * getting the tab(s)
     *
     * @param int $number Number of tabs to be added
     *
     * @return string;
     */
    public function getTab($number = 1): string
    {
        return implode('', array_fill(0, $this->tabSize * $number, ' '));
    }

    /**
     * getting the eol(s)
     *
     * @param int $number Number of tabs to be added
     *
     * @return string;
     */
    public function getEol($number = 1): string
    {
        return implode('', array_fill(0, $number, PHP_EOL));
    }

    /**
     * Prefixing all lines in the provided code with a prefix provided
     *
     * @param string $prefix
     * @param string $code
     *
     * @return string
     */
    public function prefixLines(string $prefix, string $code): string
    {
        // The preg_replace is to remove trailing spaces on empty comment lines. The rtrim is to remove lines that consist
        // of only spaces.
        return rtrim($prefix.str_replace(PHP_EOL, PHP_EOL.$prefix, preg_replace('/\*\s*'.PHP_EOL.'/', '*'.PHP_EOL, $code)));
    }

    protected function appendCode(string $code)
    {
        $this->code->append($this->indentLines($this->currentIndent, $code));
    }

    /**
     * Adding indents to lines
     *
     * @param int $tabs
     * @param string $code
     *
     * @return string
     */
    public function indentLines(int $tabs, string $code): string
    {
        return $this->prefixLines($this->getTab($tabs), $code);
    }

    /**
     * Initializing the Code Builder
     */
    public function init(): self
    {
        $this->code = new StringCollection();

        return $this;
    }

    /**
     * Initializing the file
     */
    public function initFile(): self
    {
        $this->code = new StringCollection();
        $this->code->append('<?php');

        return $this;
    }

    /**
     * @param int $number
     *
     * @return PhpCodeStream
     */
    final public function indent(int $number): self
    {
        $this->currentIndent = $number;

        return $this;
    }

    /**
     * Inserting a line(s)
     *
     * @param int $number Number of lines to insert - one by default
     *
     * @return PhpCodeStream
     */
    final public function eol(int $number = 1): self
    {
        for ($i = 0; $i < $number; $i++) {
            $this->appendCode('');
        }

        return $this;
    }

    /**
     * Building the block comment
     *
     * @param string $comment
     *
     * @return PhpCodeStream
     */
    final public function blockComment(string $comment): self
    {
        $this->appendCode('/*'.PHP_EOL.$this->prefixLines(' * ', $comment).PHP_EOL.' */');

        return $this;
    }

    /**
     * Adding the code
     *
     * @param string $code
     *
     * @return PhpCodeStream
     */
    public function code(string $code): self
    {
        $this->appendCode($code);

        return $this;
    }

    /**
     * Building the line comment
     *
     * @param string $comment
     *
     * @return PhpCodeStream
     */
    final public function lineComment(string $comment): self
    {
        $this->appendCode('// '.$comment);

        return $this;
    }

    final public function docBlockComment(DocBlockModel $docBlock): self
    {
        $code = [];
        if ($docBlock->getComment()) {
            $code[] = $docBlock->getComment();
        }

        // adding parameter annotations
        if (count($docBlock->getParameterAnnotations())) {
            if (!empty($code)) {
                $code[] = '';
            }
            foreach ($docBlock->getParameterAnnotations() as $annotation) {
                $code[] = '@param '.$annotation['text'];
            }
        }

        if (count($docBlock->getThrowsAnnotations())) {
            // adding throws annotations:
            if (!empty($code)) {
                $code[] = '';
            }
            foreach ($docBlock->getThrowsAnnotations() as $annotation) {
                $code[] = '@throws '.$annotation['text'];
            }
        }

        if (count($docBlock->getRemainingAnnotations())) {
            if (!empty($code)) {
                $code[] = '';
            }
            // adding other annotations
            foreach ($docBlock->getRemainingAnnotations() as $annotation) {
                $code[] = trim('@'.$annotation['annotation'].' '.$annotation['text']);
            }
        }

        // adding return annotation
        if ($docBlock->getReturnAnnotation()) {
            if (!empty($code)) {
                $code[] = '';
            }
            $code[] = '@return '.$docBlock->getReturnAnnotation();
        }

        $this->appendCode('/**'.PHP_EOL.$this->prefixLines(' * ', implode(PHP_EOL, $code)).PHP_EOL.' */');

        return $this;
    }

    public function clear()
    {
        $this->code = new StringCollection();
    }

    /**
     * Builds the code and returns it as string
     *
     * @return string
     */
    public function build(): string
    {
        return $this->code->implode(PHP_EOL).PHP_EOL;
    }
}
