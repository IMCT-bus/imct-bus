<script setup lang="ts">
import StopsTimeline from '@/components/shared/StopsTimeline.vue';

type RouteListItemProps = {
  routeItem: Resources.RouteResource;
  onEdit: (id: number) => void;
  onDelete: (route: Resources.RouteResource) => void;
};

defineProps<RouteListItemProps>();
</script>

<template>
  <n-list-item>
    <n-thing>
      <template #header>
      <span class="date">({{ routeItem.starts_at }})</span>  <span>{{ routeItem.name }}</span>
      </template>
      <template #action>
        <div class="actions">
          <n-button size="small" ghost type="info" @click="onEdit(routeItem.id)">Редактировать</n-button>
          <n-button size="small" @click="onDelete(routeItem)">Удалить</n-button>
        </div>
      </template>
      <n-collapse>
        <n-collapse-item title="Полный маршрут" name="1">
            <StopsTimeline v-if="routeItem.stops" :stops="routeItem.stops" />
        </n-collapse-item>
      </n-collapse>
    </n-thing>
  </n-list-item>
</template>
<style scoped lang="scss">
.actions {
  @include row;
  justify-content: flex-end;

  @include phone {
    * {
      flex-grow: 1;
    }
  }
}
</style>
