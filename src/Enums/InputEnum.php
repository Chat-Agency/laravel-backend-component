<?php

namespace  ChatAgency\LaravelBackendComponents\Enums;

Enum InputEnum : string
{
    case LABEL = 'label';
    case LEGEND = 'legend';
    case FIELDSET = 'fieldset';
    case TEXT = 'text';
    case EMAIL = 'email';
    case SEARCH = 'search';
    case SELECT = 'select';
    case CHECKBOX = 'checkbox';
    case RADIO = 'radio';
    case OPTGROUP = 'optgroup';
    case OPTION = 'option';
    case HIDDEN = 'hidden';
}
