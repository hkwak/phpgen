<?php


namespace HKwak\CodeGenerator\Models;


use Eloquent\Enumeration\AbstractEnumeration;

/**
 * Class AccessEnum
 *
 * @method static AccessEnum PRIVATE ();
 * @method static AccessEnum PROTECTED ();
 * @method static AccessEnum PUBLIC ();
 */
class AccessEnum extends AbstractEnumeration
{
    const PRIVATE = 'private';
    const PROTECTED = 'protected';
    const PUBLIC = 'public';
}
