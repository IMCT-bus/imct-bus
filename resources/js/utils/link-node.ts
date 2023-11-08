import { h } from 'vue';
import { Link } from '@inertiajs/vue3';
import route from 'ziggy-js';

/**
 * Function to get closure with Inertia Link node mounter by given route name and title.
 */
export function getLinkNode(routeName: string, title: string) {
  return () =>
    h(
      Link,
      {
        href: route(routeName),
      },
      title,
    );
}
