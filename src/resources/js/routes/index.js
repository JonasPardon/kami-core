let routes = [
    {
        url: '/',
        label: 'Dashboard',
        icon: 'columns',
    },
    {
        url: '/auth/users',
        label: 'Users',
        icon: 'users',
    },
    {
        url: '/pages',
        label: 'Pages',
        icon: 'scroll'
    },
    {
        url: '/media',
        label: 'Media library',
        icon: 'image',
    },
    {
        url: '/settings',
        label: 'Settings',
        icon: 'cogs',
    },
];

routes = routes.map(r => {
    return {
        ...r,
        url: `/admin${r.url}`,
    };
});

export default routes;
