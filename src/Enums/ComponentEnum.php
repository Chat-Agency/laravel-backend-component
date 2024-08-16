<?php

namespace  ChatAgency\BackendComponents\Enums;

enum  ComponentEnum : string
{
    case TEMPLATE = 'template';
    case DIV = 'div';
    case PARAGRAPH = 'paragraph';
    case FORM = 'form';
    
    /**
     * inline
     */
    case BUTTON = 'inline.button';
    case LINK = 'inline.link';
    case SPAN = 'inline.span';

    /**
     * Headers
     */
    case H1 = 'headers.h1';
    case H2 = 'headers.h2';
    case H3 = 'headers.h3';
    case H4 = 'headers.h4';
    case H5 = 'headers.h5';
    case H6 = 'headers.h6';

    /**
     * Inputs
     */
    case LABEL = 'inputs.label';
    case LEGEND = 'inputs.legend';
    case FIELDSET = 'inputs.fieldset';
    case TEXT = 'inputs.text';
    case EMAIL = 'inputs.email';
    case SEARCH = 'inputs.search';
    case SELECT = 'inputs.select';
    case CHECKBOX = 'inputs.checkbox';
    case RADIO = 'inputs.radio';
    case OPTGROUP = 'inputs.optgroup';
    case OPTION = 'inputs.option';
    case HIDDEN = 'inputs.hidden';

    /**
     * Table
     */
    case TABLE = 'table.table';
    case THEAD = 'table.thead';
    case TBODY = 'table.tbody';
    case TFOOT = 'table.tfoot';
    case TR = 'table.tr';
    case TH = 'table.th';
    case TD = 'table.td';
    case CAPTION = 'table.caption';
    case COLGROUP = 'table.colgroup';
    case COL = 'table.col';

    /**
     * Lists
     */
    case OL = 'lists.ol';
    case UL = 'lists.ul';
    case LI = 'lists.li';

    /**
     * Custom
     */
    case MODAL = 'custom.modal';

}
