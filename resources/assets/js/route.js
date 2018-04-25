import level                from  './components/mypage/level.vue';

// main
import Main                 from './components/main/MainPage.vue'

// groups_list
import groups_list          from './components/groups_list/main.vue'
import list_search          from './components/groups_list/list_search'
import list_show            from './components/groups_list/list_show'

// group_make
import group_make           from './components/group_make/group_make'
import group_make_main      from './components/group_make/group_make_main'

// group_update
import group_upadate        from './components/group_make/updateGroup'

// notice
import notice               from './components/notice/main'
import notice_information   from './components/notice/notice_information'

import mypage               from './components/mypage/profile.vue';
import modify               from './components/mypage/modify.vue';
import graph                from './components/mypage/graph.vue';
import update                from './components/mypage/update.vue';

// group menu tab
import GroupMenuTab         from "./components/group_menu/GroupMenuTab.vue";

// group notice
import NoticeListUp         from "./components/group_menu/group_notice/NoticeListUp.vue";
import NoticeWriteBtn       from './components/group_menu/group_notice/NoticeWriteBtn.vue';
import NoticeModifyBtn      from './components/group_menu/group_notice/NoticeModifyBtn.vue';
import NoticeDeleteBtn      from './components/group_menu/group_notice/NoticeDeleteBtn.vue';
import NoticeFormInside     from './components/group_menu/group_notice/NoticeFormInside.vue';

// group plan
import GroupPlan            from './components/group_menu/group_plan/GroupPlan.vue';
import GroupPlanMap         from './components/group_menu/group_plan/GroupPlanMap.vue';
import GroupPlanCalendar    from './components/group_menu/group_plan/GroupPlanCalendar.vue';

// group member list
import GroupMemberList      from './components/group_menu/group_member/GroupMemberList.vue';
import GroupMemberDetail    from './components/group_menu/group_member/GroupMemberDetail.vue';
// wating member list
import WaitingMemberList     from './components/group_menu/group_member/WaitingMemberList.vue';


import goo from './components/goo.vue';

// routing structure
const routes = [
    // main page
    {
        name: 'main',
        path: '/',
        component: Main,
    },
    // group menu
    {
        path: '/list',
        component: groups_list,
        children: [
            {
                path: '/list',
                components: {
                    header: list_search,
                    body: list_show,
                }
            }
        ]
    },
    {
        path: '/notice',
        component: notice,
        children: [
            {
                path: '/notice',
                components: {
                    body: notice_information
                }
            }
        ]
    },
    {
        name: 'mypage',
        path: '/mypage',
        component: mypage
    },
    {
        name: 'modify',
        path: '/modify',
        component: modify
    },
    {
        name: 'group_update',
        path: '/group_update/:groupid',
        component: group_upadate
    },
    {
        name: 'graph',
        path: '/graph',
        component: graph
    },
    {
        name: 'update',
        path: '/update',
        component: update
    },
    {
        name: 'level',
        path: '/level',
        component: level
    },
    // group menu
    {
        name        : 'GroupMenu',
        path        : '/group',
        component   : GroupMenuTab,
        children    : [
            // tab of group menu
            {
                path        : '/group/:groupid',
                components  : {
                    notice      : NoticeListUp,
                    plan        : GroupPlan,
                    member_list : GroupMemberList,
                },
                children: [
                    {
                        path        : '/group/:groupid',
                        components  : {
                            // write, modify, delete button of NoticeListUp
                            write   : NoticeWriteBtn,
                            modify  : NoticeModifyBtn,
                            delete  : NoticeDeleteBtn,
                            // components in GroupPlan
                            map         : GroupPlanMap,
                            calendar    : GroupPlanCalendar,
                            // component in GroupMemberList
                            member_detail   : GroupMemberDetail,
                            waiting_member   : WaitingMemberList,
                        },
                        children: [
                            {
                                path        : '/group/:groupid',
                                components  : {
                                    // inner form component of modal(NoticeWriteBtn, NoticeModifyBtn)
                                    form            : NoticeFormInside,
                                }
                            }
                        ]
                    }
                ]
            },
            
        ]
    },
    // group menu
    {
        path: '/list',
        component: groups_list,
        children: [
            {
                path: '/list',
                components: {
                    header: list_search,
                    body: list_show,
                }
            }
        ]
    },
    {
        path: '/make',
        component: group_make_main,
        children: [
            {
                path: '/make',
                components: {
                    make: group_make
                }
            }
        ]
    }
];

export default routes;