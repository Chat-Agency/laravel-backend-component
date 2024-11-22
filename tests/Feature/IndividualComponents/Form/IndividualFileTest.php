<?php

namespace Feature\IndividualComponents\Form;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use ChatAgency\BackendComponents\Components\Form\FileInputComponent;

class IndividualFileTest extends TestCase
{
    #[Test]
    public function empty_individual_file()
    {
        $file = new FileInputComponent();

        $this->blade('{{ $file }}', [
            'file' => $file,
        ])
            ->assertSee('<input type="file"', false);
    }
}
