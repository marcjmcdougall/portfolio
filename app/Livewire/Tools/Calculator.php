<?php

namespace App\Livewire\Tools;

use Livewire\Component;

class Calculator extends Component
{
    public $ltv;
    public $traffic;
    public $leads;
    public $customers;
    public $importance;
    public $currentLeadConversionRate;
    public $currentCustomerConversionRate;

    public $currentARR;
    public $fivePercentIncrease;
    public $onePercentIncrease;
    public $pointOnePercentIncrease;
    public $upperSuggestedPrice;
    public $lowerSuggestedPrice;

    public function mount()
    {
        // Set default values if needed
        $this->ltv = 1000;
        $this->traffic = 5000;
        $this->leads = 25;
        $this->customers = 10;
        $this->importance = 'moderate';
        
        // Run initial calculation
        $this->calculate();
    }

    // This runs whenever ANY property is updated
    public function updated()
    {
        $this->calculate();
    }

    private function calculate()
    {
        if (
            $this->traffic > 0 && 
            $this->leads > 0 
        ) {
            // Ensure we have valid numbers
            $ltv = floatval($this->ltv);
            $traffic = floatval($this->traffic);
            $leads = floatval($this->leads);
            $customers = floatval($this->customers);
            
            // Calculate current yearly revenue
            $this->currentARR = $customers * $ltv * 12;
            
            // Calculate revenue with different conversion rate increases
            $this->currentLeadConversionRate = number_format($leads / $traffic, 8);
            $this->currentCustomerConversionRate = number_format( $customers / $leads, 8);
            
            // 5% increase in conversion rate
            $newCustomers5 = $traffic * ($this->currentLeadConversionRate + .05) * $this->currentCustomerConversionRate;
            $this->fivePercentIncrease = $newCustomers5 * $ltv * 12;
            
            // 1% increase in conversion rate
            $newCustomers1 = $traffic * ($this->currentLeadConversionRate + .01) * $this->currentCustomerConversionRate;
            $this->onePercentIncrease = $newCustomers1 * $ltv * 12;
            
            // 0.1% increase in conversion rate
            $newCustomers01 = $traffic * ($this->currentLeadConversionRate + .001) * $this->currentCustomerConversionRate;
            $this->pointOnePercentIncrease = $newCustomers01 * $ltv * 12;

            // Evaluate the suggested price, which is a percentage of the difference in the first year ARR.
            $priceCalibration = 0.3;

            switch ($this->importance) {
                case 'low' :
                    $priceCalibration = 0.05;
                    break;
                case 'moderate' :
                    $priceCalibration = 0.1;
                    break;
                case 'high' :
                    $priceCalibration = 0.2;
                    break;
                default :
                    $priceCalibration = 0.1;
                    break;
            }

            $this->upperSuggestedPrice = ($this->onePercentIncrease - $this->currentARR) * $priceCalibration;
            $this->lowerSuggestedPrice = $this->upperSuggestedPrice * 0.50;
        }
        else {
            $this->currentARR = 0;
            $this->fivePercentIncrease = 0;
            $this->onePercentIncrease = 0;
            $this->pointOnePercentIncrease = 0;
        }
    }

    public function formatCurrency($amount)
    {
        return '$' . number_format($amount, 0);
    }

    public function formatPercent($amount)
    {
        $amount *= 100;
        return $amount . '%';
    }

    public function render()
    {
        return view('livewire.tools.calculator');
    }
}
