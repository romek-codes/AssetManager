<script setup lang="ts">
import {computed, onMounted, onUnmounted, watch} from 'vue';
import AssetComponentData = App.Data.AssetComponentData;

const props = withDefaults(
    defineProps<{
      show?: boolean;
      maxWidth?: 'sm' | 'md' | 'lg' | 'xl' | '2xl';
      closeable?: boolean;
      assetComponents?: AssetComponentData[]
    }>(),
    {
      show: false,
      maxWidth: '2xl',
      closeable: true,
    }
);

const emit = defineEmits(['close']);

watch(
    () => props.show,
    () => {
      if (props.show) {
        document.body.style.overflow = 'hidden';
      } else {
        document.body.style.overflow = 'visible';
      }
    }
);

const close = () => {
  if (props.closeable) {
    emit('close');
  }
};

const closeOnEscape = (e: KeyboardEvent) => {
  if (e.key === 'Escape' && props.show) {
    close();
  }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));

onUnmounted(() => {
  document.removeEventListener('keydown', closeOnEscape);
  document.body.style.overflow = 'visible';
});

const maxWidthClass = computed(() => {
  return {
    sm: 'sm:max-w-sm',
    md: 'sm:max-w-md',
    lg: 'sm:max-w-lg',
    xl: 'sm:max-w-xl',
    '2xl': 'sm:max-w-2xl',
  }[props.maxWidth];
});
</script>

<template>
  <dialog id="viewDetailsModal" class="modal">
    <div class="modal-box">
      <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
      </form>
      <div class="form-control w-96">
        <article class="pl-10 flex flex-row items-center justify-around h-14 "
                 v-for="assetComponent in asset.assetComponents" v-if="assetComponents">
          <label class="w-32">
            <input type="checkbox" class="checkbox checkbox-xs"/>
          </label>
          <div class="flex items-center space-x-3 w-32">
            <div class="avatar">
              <div class="mask mask-squircle w-12 h-12">
                <img v-if="assetComponent.image" :src="assetComponent.image?.url"
                     :alt="assetComponent.name + ' image'"/>
                <img v-else src="https://www.svgrepo.com/show/451667/image-missing.svg"
                     :alt="assetComponent.name + ' image'"/>
              </div>
            </div>
            <div>
              <div class="font-bold">{{ assetComponent.name }}</div>
              <div class="text-xs text-secondary">Name</div>
            </div>
          </div>
          <div>
            <p class="w-32">{{ assetComponent.category?.name }}</p>
            <div class="text-xs text-secondary">Category</div>
          </div>
          <div>
            <p class="w-32" v-if="assetComponent.assignedUser">{{ assetComponent.assignedUser?.firstName }}
              {{ assetComponent.assignedUser?.lastName }}</p>
            <p class="w-32" v-else> Not Assigned</p>
            <div class="text-xs text-secondary">Assigned User</div>
          </div>
        </article>
      </div>
    </div>
    <form method="dialog" class="modal-backdrop">
      <button>close</button>
    </form>
  </dialog>
</template>
