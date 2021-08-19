<?php

namespace NorthernEstateAgencies\MultiTenancy\Tests;

use NorthernEstateAgencies\MultiTenancy\MultiTenancyServiceProvider;
use NorthernEstateAgencies\MultiTenancy\Services\TenantService;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected TenantService $tenantService;

    public function setUp(): void
    {
        parent::setUp();
        $this->tenantService = $this->app->make(TenantService::class);
    }

    protected function getPackageProviders($app)
    {
        return [
            MultiTenancyServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
    }
}
