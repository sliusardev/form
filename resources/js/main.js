document.addEventListener('alpine:init', () => {
    Alpine.data('tabs', () => ({
        activeTab: null,
        init() {
            // Set the first tab as active by default
            this.activeTab = this.$el.querySelector('[data-tab]').dataset.tab;
        },
        setActiveTab(tabId) {
            this.activeTab = tabId;
        },
        isActive(tabId) {
            return this.activeTab === tabId;
        }
    }));
});
