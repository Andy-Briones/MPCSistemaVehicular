<?php

it('verifica que el código siga las reglas de estilo de Laravel Pint', function () {
    artisan('pint', ['--test' => true])->assertExitCode(0);
});

it('analiza el código con PHPStan sin errores críticos', function () {
    $output = shell_exec('vendor/bin/phpstan analyse --level=5 app');
    expect($output)->not()->toContain('error');
});
