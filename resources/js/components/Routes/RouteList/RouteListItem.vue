<script setup lang="ts">
import StopsTimeline from '@/components/shared/StopsTimeline.vue';

type RouteListItemProps = {
  routeItem: Resources.RouteResource;
  onEdit: (id: number) => void;
  onDelete: (id: number) => void;
};

defineProps<RouteListItemProps>();
</script>

<template>
  <n-list-item>
    <n-thing :description="`Время начала: ${routeItem.starts_at}`">
      <template #header>
        {{ routeItem.name }}
      </template>
      <template #action>
        <div class="actions">
          <n-button size="small" ghost type="info" @click="onEdit(routeItem.id)">Редактировать</n-button>
          <n-button size="small" @click="onDelete(routeItem.id)">Удалить</n-button>
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
