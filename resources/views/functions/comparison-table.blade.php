@extends('layouts.app')

@section('title', 'Comparison Table')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Pricing Comparison Table</h1>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr>
                        <th class="text-left p-4 border-b border-gray-200">Features</th>
                        @foreach($plans as $plan)
                        <th class="text-center p-4 border-b border-gray-200 {{ $plan['name'] === 'Professional' ? 'bg-blue-50' : '' }}">
                            <div class="mb-2">
                                <h3 class="text-xl font-bold text-gray-800">{{ $plan['name'] }}</h3>
                                <div class="text-2xl font-bold text-blue-600">${{ $plan['price'] }}</div>
                                <div class="text-sm text-gray-600">per month</div>
                            </div>
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded {{ $plan['name'] === 'Professional' ? 'bg-blue-700' : '' }}">
                                {{ $plan['name'] === 'Professional' ? 'Most Popular' : 'Get Started' }}
                            </button>
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200">
                        <td class="p-4 font-medium text-gray-700">Storage Space</td>
                        @foreach($plans as $plan)
                        <td class="p-4 text-center {{ $plan['name'] === 'Professional' ? 'bg-blue-50' : '' }}">
                            <span class="text-gray-800">{{ $plan['features']['storage'] }}</span>
                        </td>
                        @endforeach
                    </tr>

                    <tr class="border-b border-gray-200">
                        <td class="p-4 font-medium text-gray-700">Bandwidth</td>
                        @foreach($plans as $plan)
                        <td class="p-4 text-center {{ $plan['name'] === 'Professional' ? 'bg-blue-50' : '' }}">
                            <span class="text-gray-800">{{ $plan['features']['bandwidth'] }}</span>
                        </td>
                        @endforeach
                    </tr>

                    <tr class="border-b border-gray-200">
                        <td class="p-4 font-medium text-gray-700">Email Accounts</td>
                        @foreach($plans as $plan)
                        <td class="p-4 text-center {{ $plan['name'] === 'Professional' ? 'bg-blue-50' : '' }}">
                            <span class="text-gray-800">{{ $plan['features']['email'] }}</span>
                        </td>
                        @endforeach
                    </tr>

                    <tr class="border-b border-gray-200">
                        <td class="p-4 font-medium text-gray-700">Support</td>
                        @foreach($plans as $plan)
                        <td class="p-4 text-center {{ $plan['name'] === 'Professional' ? 'bg-blue-50' : '' }}">
                            <span class="text-gray-800">{{ $plan['features']['support'] }}</span>
                        </td>
                        @endforeach
                    </tr>

                    <tr class="border-b border-gray-200">
                        <td class="p-4 font-medium text-gray-700">SSL Certificate</td>
                        @foreach($plans as $plan)
                        <td class="p-4 text-center {{ $plan['name'] === 'Professional' ? 'bg-blue-50' : '' }}">
                            @if($plan['features']['ssl'])
                                <span class="text-green-600">✓</span>
                            @else
                                <span class="text-red-600">✗</span>
                            @endif
                        </td>
                        @endforeach
                    </tr>

                    <tr class="border-b border-gray-200">
                        <td class="p-4 font-medium text-gray-700">Backup</td>
                        @foreach($plans as $plan)
                        <td class="p-4 text-center {{ $plan['name'] === 'Professional' ? 'bg-blue-50' : '' }}">
                            @if($plan['features']['backup'])
                                <span class="text-green-600">✓</span>
                            @else
                                <span class="text-red-600">✗</span>
                            @endif
                        </td>
                        @endforeach
                    </tr>

                    <tr class="border-b border-gray-200">
                        <td class="p-4 font-medium text-gray-700">Analytics</td>
                        @foreach($plans as $plan)
                        <td class="p-4 text-center {{ $plan['name'] === 'Professional' ? 'bg-blue-50' : '' }}">
                            @if($plan['features']['analytics'])
                                <span class="text-green-600">✓</span>
                            @else
                                <span class="text-red-600">✗</span>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Interactive Comparison -->
        <div class="mt-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Interactive Comparison</h2>
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select plans to compare:</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach($plans as $index => $plan)
                        <label class="flex items-center">
                            <input type="checkbox" class="plan-checkbox mr-2" data-plan="{{ $index }}" {{ $index < 2 ? 'checked' : '' }}>
                            <span class="text-sm">{{ $plan['name'] }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Highlight differences:</label>
                    <label class="flex items-center">
                        <input type="checkbox" id="highlightDifferences" class="mr-2">
                        <span class="text-sm">Show only different features</span>
                    </label>
                </div>

                <div id="dynamicComparison" class="overflow-x-auto">
                    <!-- Dynamic comparison table will be generated here -->
                </div>
            </div>
        </div>

        <!-- Feature Weights -->
        <div class="mt-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Feature Importance Rating</h2>
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Storage Importance:</label>
                        <input type="range" id="storageWeight" class="w-full" min="1" max="5" value="3">
                        <div class="flex justify-between text-xs text-gray-600">
                            <span>Low</span>
                            <span>High</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Support Importance:</label>
                        <input type="range" id="supportWeight" class="w-full" min="1" max="5" value="4">
                        <div class="flex justify-between text-xs text-gray-600">
                            <span>Low</span>
                            <span>High</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Price Importance:</label>
                        <input type="range" id="priceWeight" class="w-full" min="1" max="5" value="5">
                        <div class="flex justify-between text-xs text-gray-600">
                            <span>Low</span>
                            <span>High</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Features Importance:</label>
                        <input type="range" id="featuresWeight" class="w-full" min="1" max="5" value="3">
                        <div class="flex justify-between text-xs text-gray-600">
                            <span>Low</span>
                            <span>High</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-4">Recommendation Based on Your Preferences:</h3>
                    <div id="recommendation" class="bg-white p-4 rounded-lg border border-gray-200">
                        <!-- Recommendation will be generated here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">Comparison Table Implementation:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
class ComparisonTable {
    constructor(plans) {
        this.plans = plans;
        this.selectedPlans = [0, 1]; // Default to first two plans
        this.weights = {
            storage: 3,
            support: 4,
            price: 5,
            features: 3
        };
        this.init();
    }

    init() {
        this.bindEvents();
        this.generateDynamicComparison();
        this.generateRecommendation();
    }

    bindEvents() {
        // Plan selection checkboxes
        document.querySelectorAll('.plan-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                this.updateSelectedPlans();
            });
        });

        // Weight sliders
        document.getElementById('storageWeight').addEventListener('input', (e) => {
            this.weights.storage = parseInt(e.target.value);
            this.generateRecommendation();
        });

        document.getElementById('supportWeight').addEventListener('input', (e) => {
            this.weights.support = parseInt(e.target.value);
            this.generateRecommendation();
        });

        document.getElementById('priceWeight').addEventListener('input', (e) => {
            this.weights.price = parseInt(e.target.value);
            this.generateRecommendation();
        });

        document.getElementById('featuresWeight').addEventListener('input', (e) => {
            this.weights.features = parseInt(e.target.value);
            this.generateRecommendation();
        });

        // Highlight differences
        document.getElementById('highlightDifferences').addEventListener('change', () => {
            this.generateDynamicComparison();
        });
    }

    updateSelectedPlans() {
        this.selectedPlans = [];
        document.querySelectorAll('.plan-checkbox').forEach((checkbox, index) => {
            if (checkbox.checked) {
                this.selectedPlans.push(index);
            }
        });
        this.generateDynamicComparison();
        this.generateRecommendation();
    }

    generateDynamicComparison() {
        const container = document.getElementById('dynamicComparison');
        const highlightDifferences = document.getElementById('highlightDifferences').checked;

        if (this.selectedPlans.length === 0) {
            container.innerHTML = '<p class="text-gray-500">Please select at least one plan to compare.</p>';
            return;
        }

        const selectedPlansData = this.selectedPlans.map(index => this.plans[index]);
        const features = ['storage', 'bandwidth', 'email', 'support', 'ssl', 'backup', 'analytics'];

        let html = '<table class="w-full border-collapse border border-gray-200">';

        // Header
        html += '<thead><tr class="bg-gray-50">';
        html += '<th class="text-left p-4 border border-gray-200">Feature</th>';
        selectedPlansData.forEach(plan => {
            html += `<th class="text-center p-4 border border-gray-200">${plan.name}</th>`;
        });
        html += '</tr></thead>';

        // Body
        html += '<tbody>';
        features.forEach(feature => {
            const values = selectedPlansData.map(plan => plan.features[feature]);
            const hasUniqueValues = new Set(values).size > 1;

            if (!highlightDifferences || hasUniqueValues) {
                html += '<tr class="border-b border-gray-200">';
                html += `<td class="p-4 font-medium text-gray-700 capitalize">${feature.replace('_', ' ')}</td>`;

                selectedPlansData.forEach(plan => {
                    const value = plan.features[feature];
                    const cellClass = hasUniqueValues && highlightDifferences ? 'bg-yellow-50' : '';

                    if (typeof value === 'boolean') {
                        html += `<td class="p-4 text-center ${cellClass}">`;
                        html += value ? '<span class="text-green-600">✓</span>' : '<span class="text-red-600">✗</span>';
                        html += '</td>';
                    } else {
                        html += `<td class="p-4 text-center ${cellClass}">${value}</td>`;
                    }
                });

                html += '</tr>';
            }
        });
        html += '</tbody></table>';

        container.innerHTML = html;
    }

    calculatePlanScore(plan) {
        let score = 0;

        // Price score (lower is better)
        const maxPrice = Math.max(...this.plans.map(p => p.price));
        const priceScore = (maxPrice - plan.price) / maxPrice * 100;
        score += priceScore * this.weights.price;

        // Storage score
        const storageValue = plan.features.storage === 'Unlimited' ? 1000 :
                           parseInt(plan.features.storage.replace('GB', ''));
        score += (storageValue / 1000) * 100 * this.weights.storage;

        // Support score
        const supportScores = {
            'Email': 20,
            'Email & Chat': 60,
            '24/7 Phone': 100
        };
        score += supportScores[plan.features.support] * this.weights.support;

        // Features score
        const featureCount = ['ssl', 'backup', 'analytics'].filter(f => plan.features[f]).length;
        score += (featureCount / 3) * 100 * this.weights.features;

        return score;
    }

    generateRecommendation() {
        const selectedPlansData = this.selectedPlans.map(index => this.plans[index]);

        if (selectedPlansData.length === 0) {
            document.getElementById('recommendation').innerHTML = '<p class="text-gray-500">Please select plans to get a recommendation.</p>';
            return;
        }

        const scores = selectedPlansData.map(plan => ({
            plan: plan,
            score: this.calculatePlanScore(plan)
        }));

        scores.sort((a, b) => b.score - a.score);

        const topPlan = scores[0];

        let html = `
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <h4 class="text-lg font-semibold text-green-600">${topPlan.plan.name}</h4>
                    <p class="text-gray-600">Best match for your preferences</p>
                    <div class="text-sm text-gray-500">Score: ${topPlan.score.toFixed(1)}/100</div>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-blue-600">$${topPlan.plan.price}</div>
                    <div class="text-sm text-gray-600">per month</div>
                </div>
            </div>
        `;

        if (scores.length > 1) {
            html += '<div class="mt-4 pt-4 border-t border-gray-200">';
            html += '<h5 class="font-medium mb-2">Other options:</h5>';
            scores.slice(1).forEach(item => {
                html += `
                    <div class="flex justify-between items-center py-1">
                        <span class="text-gray-700">${item.plan.name}</span>
                        <span class="text-sm text-gray-500">Score: ${item.score.toFixed(1)}</span>
                    </div>
                `;
            });
            html += '</div>';
        }

        document.getElementById('recommendation').innerHTML = html;
    }
}

const comparisonTable = new ComparisonTable(plans);
        </code></pre>
    </div>
</div>

<script>
class ComparisonTable {
    constructor(plans) {
        this.plans = plans;
        this.selectedPlans = [0, 1]; // Default to first two plans
        this.weights = {
            storage: 3,
            support: 4,
            price: 5,
            features: 3
        };
        this.init();
    }

    init() {
        this.bindEvents();
        this.generateDynamicComparison();
        this.generateRecommendation();
    }

    bindEvents() {
        // Plan selection checkboxes
        document.querySelectorAll('.plan-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                this.updateSelectedPlans();
            });
        });

        // Weight sliders
        document.getElementById('storageWeight').addEventListener('input', (e) => {
            this.weights.storage = parseInt(e.target.value);
            this.generateRecommendation();
        });

        document.getElementById('supportWeight').addEventListener('input', (e) => {
            this.weights.support = parseInt(e.target.value);
            this.generateRecommendation();
        });

        document.getElementById('priceWeight').addEventListener('input', (e) => {
            this.weights.price = parseInt(e.target.value);
            this.generateRecommendation();
        });

        document.getElementById('featuresWeight').addEventListener('input', (e) => {
            this.weights.features = parseInt(e.target.value);
            this.generateRecommendation();
        });

        // Highlight differences
        document.getElementById('highlightDifferences').addEventListener('change', () => {
            this.generateDynamicComparison();
        });
    }

    updateSelectedPlans() {
        this.selectedPlans = [];
        document.querySelectorAll('.plan-checkbox').forEach((checkbox, index) => {
            if (checkbox.checked) {
                this.selectedPlans.push(index);
            }
        });
        this.generateDynamicComparison();
        this.generateRecommendation();
    }

    generateDynamicComparison() {
        const container = document.getElementById('dynamicComparison');
        const highlightDifferences = document.getElementById('highlightDifferences').checked;

        if (this.selectedPlans.length === 0) {
            container.innerHTML = '<p class="text-gray-500">Please select at least one plan to compare.</p>';
            return;
        }

        const selectedPlansData = this.selectedPlans.map(index => this.plans[index]);
        const features = ['storage', 'bandwidth', 'email', 'support', 'ssl', 'backup', 'analytics'];

        let html = '<table class="w-full border-collapse border border-gray-200">';

        // Header
        html += '<thead><tr class="bg-gray-50">';
        html += '<th class="text-left p-4 border border-gray-200">Feature</th>';
        selectedPlansData.forEach(plan => {
            html += `<th class="text-center p-4 border border-gray-200">${plan.name}</th>`;
        });
        html += '</tr></thead>';

        // Body
        html += '<tbody>';
        features.forEach(feature => {
            const values = selectedPlansData.map(plan => plan.features[feature]);
            const hasUniqueValues = new Set(values).size > 1;

            if (!highlightDifferences || hasUniqueValues) {
                html += '<tr class="border-b border-gray-200">';
                html += `<td class="p-4 font-medium text-gray-700 capitalize">${feature.replace('_', ' ')}</td>`;

                selectedPlansData.forEach(plan => {
                    const value = plan.features[feature];
                    const cellClass = hasUniqueValues && highlightDifferences ? 'bg-yellow-50' : '';

                    if (typeof value === 'boolean') {
                        html += `<td class="p-4 text-center ${cellClass}">`;
                        html += value ? '<span class="text-green-600">✓</span>' : '<span class="text-red-600">✗</span>';
                        html += '</td>';
                    } else {
                        html += `<td class="p-4 text-center ${cellClass}">${value}</td>`;
                    }
                });

                html += '</tr>';
            }
        });
        html += '</tbody></table>';

        container.innerHTML = html;
    }

    calculatePlanScore(plan) {
        let score = 0;

        // Price score (lower is better)
        const maxPrice = Math.max(...this.plans.map(p => p.price));
        const priceScore = (maxPrice - plan.price) / maxPrice * 100;
        score += priceScore * this.weights.price;

        // Storage score
        const storageValue = plan.features.storage === 'Unlimited' ? 1000 :
                           parseInt(plan.features.storage.replace('GB', ''));
        score += (storageValue / 1000) * 100 * this.weights.storage;

        // Support score
        const supportScores = {
            'Email': 20,
            'Email & Chat': 60,
            '24/7 Phone': 100
        };
        score += supportScores[plan.features.support] * this.weights.support;

        // Features score
        const featureCount = ['ssl', 'backup', 'analytics'].filter(f => plan.features[f]).length;
        score += (featureCount / 3) * 100 * this.weights.features;

        return score;
    }

    generateRecommendation() {
        const selectedPlansData = this.selectedPlans.map(index => this.plans[index]);

        if (selectedPlansData.length === 0) {
            document.getElementById('recommendation').innerHTML = '<p class="text-gray-500">Please select plans to get a recommendation.</p>';
            return;
        }

        const scores = selectedPlansData.map(plan => ({
            plan: plan,
            score: this.calculatePlanScore(plan)
        }));

        scores.sort((a, b) => b.score - a.score);

        const topPlan = scores[0];

        let html = `
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <h4 class="text-lg font-semibold text-green-600">${topPlan.plan.name}</h4>
                    <p class="text-gray-600">Best match for your preferences</p>
                    <div class="text-sm text-gray-500">Score: ${topPlan.score.toFixed(1)}/100</div>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-blue-600">$${topPlan.plan.price}</div>
                    <div class="text-sm text-gray-600">per month</div>
                </div>
            </div>
        `;

        if (scores.length > 1) {
            html += '<div class="mt-4 pt-4 border-t border-gray-200">';
            html += '<h5 class="font-medium mb-2">Other options:</h5>';
            scores.slice(1).forEach(item => {
                html += `
                    <div class="flex justify-between items-center py-1">
                        <span class="text-gray-700">${item.plan.name}</span>
                        <span class="text-sm text-gray-500">Score: ${item.score.toFixed(1)}</span>
                    </div>
                `;
            });
            html += '</div>';
        }

        document.getElementById('recommendation').innerHTML = html;
    }
}

// Initialize
let comparisonTable;
document.addEventListener('DOMContentLoaded', function() {
    const plans = @json($plans);
    comparisonTable = new ComparisonTable(plans);

    setTimeout(() => {
        showInfo('Comparison table loaded! Try adjusting the feature weights to get personalized recommendations.');
    }, 1000);
});
</script>
@endsection
