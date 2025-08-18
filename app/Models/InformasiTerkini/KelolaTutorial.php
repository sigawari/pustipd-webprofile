<?php

namespace App\Models\InformasiTerkini;

use App\Models\Publics;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KelolaTutorial extends Model
{
    protected $table = 'kelola_tutorials';

    /** @use HasFactory<\Database\Factories\KelolaTutorialFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'category',
        'date',
        'status',
        'tags',
        'is_featured',
        'is_hidden',   
        'content_blocks',
        'view_count',
    ];
    
    
    protected $casts = [
        'date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'tags' => 'array',
        'content_blocks' => 'array',
        'view_count' => 'integer',
        'is_hidden' => 'boolean',   // casting boolean
    ];
    
        public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true); // Pastikan ada kolom is_featured
    }

    // Scope untuk filter tutorial yang tidak disembunyikan (visible)
    public function scopeVisible($query)
    {
        return $query->where('is_hidden', false);
    }

    
    public function publics () {
        return $this->hasMany(Publics::class);
    }

    protected $primaryKey = 'id'; // atau kolom sebenarnya
    public $incrementing = true;
    protected $keyType = 'int'; 


    // ... existing scopes and methods ...

    // ================================
    // CONTENT BLOCKS METHODS
    // ================================

    /**
     * Get content blocks with proper structure.
     */
    public function getContentBlocks()
    {
        return $this->content_blocks ? json_decode($this->content_blocks, true) : [];
    }

    public function hasImages()
    {
        $blocks = $this->getContentBlocks();
        return collect($blocks)->some(function($block) {
            return !empty($block['image']);
        });
    }

    public function getAllImages()
    {
        $blocks = $this->getContentBlocks();
        return collect($blocks)
            ->pluck('image')
            ->filter()
            ->values()
            ->toArray();
    }


    /**
     * Get only step blocks.
     */
    public function getStepBlocks(): array
    {
        return collect($this->getContentBlocks())
            ->where('type', 'step')
            ->sortBy('order')
            ->values()
            ->toArray();
    }

    /**
     * Get only tip blocks.
     */
    public function getTipBlocks(): array
    {
        return collect($this->getContentBlocks())
            ->where('type', 'tip')
            ->sortBy('order')
            ->values()
            ->toArray();
    }

    /**
     * Count steps in tutorial.
     */
    public function getStepCount(): int
    {
        return count($this->getStepBlocks());
    }

    /**
     * Count tips in tutorial.
     */
    public function getTipCount(): int
    {
        return count($this->getTipBlocks());
    }

    /**
     * Generate content from blocks for search/display.
     */
    public function getContentFromBlocks(): string
    {
        $content = '';
        foreach ($this->getContentBlocks() as $block) {
            if (isset($block['title'])) {
                $content .= $block['title'] . ' ';
            }
            if (isset($block['content'])) {
                $content .= $block['content'] . ' ';
            }
        }
        return trim($content);
    }

    // Update search scope untuk include content blocks
    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function($q) use ($search) {
            $keywords = preg_split('/\s+/', trim($search));
            foreach ($keywords as $word) {
                $q->where(function($q) use ($word) {
                    $q->where('title', 'like', "%{$word}%")
                      ->orWhere('excerpt', 'like', "%{$word}%")
                      ->orWhere('content', 'like', "%{$word}%")
                      ->orWhere('category', 'like', "%{$word}%")
                      ->orWhereJsonContains('tags', $word)
                      ->orWhereRaw('JSON_EXTRACT(content_blocks, "$[*].title") LIKE ?', ["%{$word}%"])
                      ->orWhereRaw('JSON_EXTRACT(content_blocks, "$[*].content") LIKE ?', ["%{$word}%"]);
                });
            }
        });
    }

    /**
     * Scope untuk tutorial populer berdasarkan views.
     */
    public function scopePopular(Builder $query, int $limit = 10): Builder
    {
        return $query->orderByDesc('view_count')->limit($limit);
    }

    /**
     * Scope untuk tutorial dengan view count minimum.
     */
    public function scopeMinViews(Builder $query, int $minViews): Builder
    {
        return $query->where('view_count', '>=', $minViews);
    }

    // ================================
    // ACCESSORS & MUTATORS
    // ================================

    /**
     * Get kategori data untuk display berdasarkan analisis PUSTIPD.
     */
    public function getCategoryDataAttribute(): array
    {
        $categories = [
            'sistem_informasi_akademik' => [
                'label' => 'Sistem Informasi Akademik',
                'icon' => '🎓',
                'color' => 'bg-blue-100 text-blue-800'
            ],
            'e_learning' => [
                'label' => 'E-Learning & Pembelajaran Daring',
                'icon' => '💻',
                'color' => 'bg-green-100 text-green-800'
            ],
            'layanan_digital_mahasiswa' => [
                'label' => 'Layanan Digital Mahasiswa',
                'icon' => '👨‍🎓',
                'color' => 'bg-purple-100 text-purple-800'
            ],
            'pengelolaan_data_akun' => [
                'label' => 'Pengelolaan Data & Akun',
                'icon' => '🔐',
                'color' => 'bg-orange-100 text-orange-800'
            ],
            'jaringan_konektivitas' => [
                'label' => 'Jaringan & Konektivitas',
                'icon' => '🌐',
                'color' => 'bg-cyan-100 text-cyan-800'
            ],
            'software_aplikasi' => [
                'label' => 'Software & Aplikasi',
                'icon' => '📱',
                'color' => 'bg-indigo-100 text-indigo-800'
            ],
            'penelitian_akademik' => [
                'label' => 'Penelitian & Akademik',
                'icon' => '📚',
                'color' => 'bg-yellow-100 text-yellow-800'
            ],
            'layanan_publik' => [
                'label' => 'Layanan Publik',
                'icon' => '🏛️',
                'color' => 'bg-gray-100 text-gray-800'
            ],
        ];
        
        return $categories[$this->category] ?? [
            'label' => ucfirst(str_replace('_', ' ', $this->category)),
            'icon' => '📄',
            'color' => 'bg-gray-100 text-gray-800'
        ];
    }

    /**
     * Get status color untuk badge display.
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'published' => 'bg-green-100 text-green-800',
            'draft' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Get formatted date.
     */
    public function getFormattedDateAttribute(): string
    {
        if (!$this->date) {
            return '';
        }
        $date = $this->date instanceof \Carbon\Carbon ? $this->date : \Carbon\Carbon::parse($this->date);
        return $date->format('d M Y');
    }

    /**
     * Get view count in human readable format.
     */
    public function getViewCountHumanAttribute(): string
    {
        if ($this->view_count < 1000) {
            return $this->view_count . ' views';
        }
        
        if ($this->view_count < 1000000) {
            return round($this->view_count / 1000, 1) . 'K views';
        }
        
        return round($this->view_count / 1000000, 1) . 'M views';
    }

    /**
     * Get share URLs untuk social media.
     */
    public function getShareUrlsAttribute(): array
    {
        $url = route('tutorial.show', $this->slug);
        $title = urlencode("Tutorial PUSTIPD: " . $this->title);
        $excerpt = urlencode($this->excerpt ?: Str::limit(strip_tags($this->content), 100));
        
        return [
            'whatsapp' => "https://wa.me/?text={$title}%20{$url}",
            'facebook' => "https://www.facebook.com/sharer/sharer.php?u={$url}&quote={$title}",
            'telegram' => "https://t.me/share/url?url={$url}&text={$title}",
            'twitter' => "https://twitter.intent/tweet?text={$title}&url={$url}",
            'linkedin' => "https://www.linkedin.com/sharing/share-offsite/?url={$url}",
            'copy' => $url
        ];
    }

    // ================================
    // METHODS
    // ================================

    /**
     * Check apakah tutorial aktif (published).
     */
    public function isActive(): bool
    {
        return $this->status === 'published';
    }

    /**
     * Increment view count.
     */
    public function incrementView(): void
    {
        $this->increment('view_count');
    }

    /**
     * Reset view count.
     */
    public function resetViewCount(): void
    {
        $this->update(['view_count' => 0]);
    }

    /**
     * Generate excerpt dari content jika belum ada.
     */
    public function generateExcerpt(int $length = 150): string
    {
        if ($this->excerpt) {
            return $this->excerpt;
        }
        
        $stripped = strip_tags($this->content);
        return Str::limit($stripped, $length);
    }

    /**
     * Get reading time estimation.
     */
    public function getReadingTime(): int
    {
        $wordCount = str_word_count(strip_tags($this->content));
        return ceil($wordCount / 200); // Asumsi 200 kata per menit
    }

    /**
     * Check if tutorial is popular based on view count.
     */
    public function isPopular(int $threshold = 100): bool
    {
        return $this->view_count >= $threshold;
    }

    // ================================
    // STATIC METHODS
    // ================================

    /**
     * Get available categories untuk PUSTIPD berdasarkan analisis.
     */
    public static function getCategories(): array
    {
        return [
            'sistem_informasi_akademik' => 'Sistem Informasi Akademik',
            'e_learning' => 'E-Learning & Pembelajaran Daring',
            'layanan_digital_mahasiswa' => 'Layanan Digital Mahasiswa',
            'pengelolaan_data_akun' => 'Pengelolaan Data & Akun',
            'jaringan_konektivitas' => 'Jaringan & Konektivitas',
            'software_aplikasi' => 'Software & Aplikasi',
            'penelitian_akademik' => 'Penelitian & Akademik',
            'layanan_publik' => 'Layanan Publik',
        ];
    }

    /**
     * Get available statuses (hanya draft dan published).
     */
    public static function getStatuses(): array
    {
        return [
            'draft' => 'Draft',
            'published' => 'Published',
        ];
    }

    /**
     * Get tutorial untuk public display.
     */
    public static function getPublicTutorials()
    {
        return static::published()
                    ->orderByDesc('date');
    }

    /**
     * Get featured tutorials.
     */
    public static function getFeaturedTutorials(int $limit = 5)
    {
        return static::published()
                    ->featured()
                    ->orderByDesc('view_count')
                    ->limit($limit);
    }

    /**
     * Get popular tutorials berdasarkan views.
     */
    public static function getPopularTutorials(int $limit = 10)
    {
        return static::published()
                    ->popular($limit)
                    ->get();
    }

    /**
     * Get tutorials dengan view count tertinggi.
     */
    public static function getMostViewedTutorials(int $limit = 5)
    {
        return static::published()
                    ->orderByDesc('view_count')
                    ->limit($limit)
                    ->get();
    }

    /**
     * Get recent tutorials.
     */
    public static function getRecentTutorials(int $limit = 10)
    {
        return static::published()
                    ->orderByDesc('created_at')
                    ->limit($limit)
                    ->get();
    }

    /**
     * Get tutorials by category dengan pagination.
     */
    public static function getTutorialsByCategory(string $category, int $perPage = 10)
    {
        return static::published()
                    ->category($category)
                    ->orderByDesc('date')
                    ->paginate($perPage);
    }

    /**
     * Get statistics untuk dashboard.
     */
    public static function getStatistics(): array
    {
        return [
            'total' => static::count(),
            'published' => static::published()->count(),
            'draft' => static::draft()->count(),
            'featured' => static::featured()->count(),
            'total_views' => static::sum('view_count'),
            'most_viewed' => static::published()->orderByDesc('view_count')->first(),
            'recent_count' => static::published()->where('created_at', '>=', now()->subDays(7))->count(),
            'popular_threshold' => static::published()->where('view_count', '>=', 100)->count(),
        ];
    }

    /**
     * Get category statistics.
     */
    public static function getCategoryStatistics(): array
    {
        $categories = static::getCategories();
        $stats = [];
        
        foreach ($categories as $key => $name) {
            $stats[$key] = [
                'name' => $name,
                'count' => static::published()->category($key)->count(),
                'total_views' => static::published()->category($key)->sum('view_count'),
                'most_viewed' => static::published()->category($key)->orderByDesc('view_count')->first()
            ];
        }
        
        return $stats;
    }

    /**
     * Search tutorials dengan advanced filtering.
     */
    public static function searchTutorials(array $filters = [])
    {
        $query = static::published();
        
        if (!empty($filters['search'])) {
            $query->search($filters['search']);
        }
        
        if (!empty($filters['category'])) {
            $query->category($filters['category']);
        }
        
        if (!empty($filters['featured'])) {
            $query->featured();
        }
        
        if (!empty($filters['min_views'])) {
            $query->minViews($filters['min_views']);
        }
        
        if (!empty($filters['tags'])) {
            foreach ($filters['tags'] as $tag) {
                $query->whereJsonContains('tags', $tag);
            }
        }
        
        // Default ordering
        $orderBy = $filters['order_by'] ?? 'date';
        $orderDirection = $filters['order_direction'] ?? 'desc';
        
        return $query->orderBy($orderBy, $orderDirection);
    }
}
