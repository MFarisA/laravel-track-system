<script setup lang="ts">
import type { SidebarProps } from '@/components/ui/sidebar';
import { computed } from 'vue';
import { usePage, Link, router } from '@inertiajs/vue3';
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/components/ui/alert-dialog';
import {
    LayoutDashboard,
    Users,
    Truck,
    Route,
    AlertTriangle,
    FileText,
    Receipt,
    MapPin,
    Settings,
    LogOut,
    GalleryVerticalEnd,
} from 'lucide-vue-next';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarGroup,
    SidebarGroupContent,
    SidebarGroupLabel,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarRail,
} from '@/components/ui/sidebar';

const props = defineProps<SidebarProps>();

const page = usePage();
const user = computed(() => page.props.auth?.user);

const handleLogout = () => {
    router.post('/logout');
};

const data = {
    navMain: [
        {
            title: 'Navigation',
            items: [
                { title: 'Dashboard', url: '/dashboard', icon: LayoutDashboard },
                { title: 'Drivers', url: '/drivers', icon: Users },
                { title: 'Vehicles', url: '/vehicles', icon: Truck },
                { title: 'Trips', url: '/trips', icon: Route },
                { title: 'Live Map', url: '/live-maps', icon: MapPin },
            ],
        },
        {
            title: 'Management',
            items: [
                { title: 'Alerts', url: '/alerts', icon: AlertTriangle },
                { title: 'Reports', url: '/reports', icon: FileText },
                { title: 'Billing', url: '/billing', icon: Receipt },
                { title: 'Settings', url: '/settings', icon: Settings },
            ],
        },
    ],
};
</script>

<template>
    <Sidebar v-bind="props">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg">
                        <div class="bg-sidebar-primary text-sidebar-primary-foreground flex aspect-square size-8 items-center justify-center rounded-lg">
                            <GalleryVerticalEnd class="size-4" />
                        </div>
                        <div class="flex flex-col gap-0.5 leading-none">
                            <span class="font-medium">Fleet Track</span>
                            <span class="text-muted-foreground text-xs">Admin Panel</span>
                        </div>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <SidebarGroup v-for="group in data.navMain" :key="group.title">
                <SidebarGroupLabel>{{ group.title }}</SidebarGroupLabel>
                <SidebarGroupContent>
                    <SidebarMenu>
                        <SidebarMenuItem v-for="item in group.items" :key="item.title">
                            <SidebarMenuButton as-child :is-active="$page.url.startsWith(item.url)">
                                <Link :href="item.url">
                                    <component :is="item.icon" />
                                    <span>{{ item.title }}</span>
                                </Link>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    </SidebarMenu>
                </SidebarGroupContent>
            </SidebarGroup>
        </SidebarContent>

        <SidebarFooter>
            <SidebarMenu>
                <SidebarMenuItem>
                    <AlertDialog>
                        <AlertDialogTrigger as-child>
                            <SidebarMenuButton class="w-full">
                                <LogOut />
                                <span>{{ user?.name || 'Logout' }}</span>
                            </SidebarMenuButton>
                        </AlertDialogTrigger>
                        <AlertDialogContent>
                            <AlertDialogHeader>
                                <AlertDialogTitle>Logout</AlertDialogTitle>
                                <AlertDialogDescription>
                                    Are you sure you want to logout from the admin dashboard?
                                </AlertDialogDescription>
                            </AlertDialogHeader>
                            <AlertDialogFooter>
                                <AlertDialogCancel>Cancel</AlertDialogCancel>
                                <AlertDialogAction @click="handleLogout">Logout</AlertDialogAction>
                            </AlertDialogFooter>
                        </AlertDialogContent>
                    </AlertDialog>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarFooter>
        <SidebarRail />
    </Sidebar>
</template>
